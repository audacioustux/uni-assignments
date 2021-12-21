package com.audacioustux.braindrop.controller;

import java.io.IOException;
import java.util.List;

import javax.validation.Valid;

import com.audacioustux.braindrop.exception.ResourceNotFoundException;
import com.audacioustux.braindrop.model.Drop;
import com.audacioustux.braindrop.model.DropReply;
import com.audacioustux.braindrop.model.User;
import com.audacioustux.braindrop.payload.DropReplyRequest;
import com.audacioustux.braindrop.payload.DropRequest;
import com.audacioustux.braindrop.repository.DropReplyRepository;
import com.audacioustux.braindrop.repository.DropRepository;
import com.audacioustux.braindrop.repository.UserRepository;
import com.audacioustux.braindrop.security.CurrentUser;
import com.audacioustux.braindrop.security.UserPrincipal;
import com.sendgrid.Method;
import com.sendgrid.Request;
import com.sendgrid.Response;
import com.sendgrid.SendGrid;
import com.sendgrid.helpers.mail.Mail;
import com.sendgrid.helpers.mail.objects.Content;
import com.sendgrid.helpers.mail.objects.Email;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class DropController {

    @Autowired
    private UserRepository userRepository;
    @Autowired
    private DropRepository dropRepository;
    @Autowired
    private DropReplyRepository dropReplyRepository;

    @PostMapping("/drop")
    public ResponseEntity<?> newDrop(@Valid @RequestBody DropRequest dropRequest) {
        Drop drop = new Drop();
        drop.setContent(dropRequest.getContent());
        drop.setProvider(dropRequest.getProvider());
        drop.setProviderUsername(dropRequest.getProviderUsername());

        Drop result = dropRepository.save(drop);

        return ResponseEntity.ok(result);
    }

    @PostMapping("/drop/reply")
    @PreAuthorize("hasRole('USER')")
    public ResponseEntity<?> newDropReply(@CurrentUser UserPrincipal userPrincipal,
            @Valid @RequestBody DropReplyRequest dropReplyRequest) throws IOException {
        User user = userRepository.findById(userPrincipal.getId())
                .orElseThrow(() -> new ResourceNotFoundException("User", "id", userPrincipal.getId()));

        Drop drop = dropRepository.getById(dropReplyRequest.getRepliedTo().getId());
        DropReply dropReply = new DropReply();
        dropReply.setContent(dropReplyRequest.getContent());
        dropReply.setRepliedTo(drop);

        DropReply result = dropReplyRepository.save(dropReply);

        Email from = new Email("test@example.com");
        Email to = new Email("@icloud.com");
        String subject = "Sending with Twilio SendGrid is Fun";
        Content content = new Content("text/html", "and <em>easy</em> to do anywhere with <strong>Java</strong>");

        Mail mail = new Mail(from, subject, to, content);

        SendGrid sg = new SendGrid(System.getenv("SENDGRID_API_KEY"));
        Request request = new Request();

        request.setMethod(Method.POST);
        request.setEndpoint("mail/send");
        request.setBody(mail.build());

        Response response = sg.api(request);

        System.out.println(response.getStatusCode());
        System.out.println(response.getHeaders());
        System.out.println(response.getBody());
        return ResponseEntity.ok("ok");
    }

    @GetMapping("/drops")
    @PreAuthorize("hasRole('USER')")
    public List<Drop> getDrops(@CurrentUser UserPrincipal userPrincipal) {
        User user = userRepository.findById(userPrincipal.getId())
                .orElseThrow(() -> new ResourceNotFoundException("User", "id", userPrincipal.getId()));
        return dropRepository.findByProviderUsername(user.getEmail());
    }
}
