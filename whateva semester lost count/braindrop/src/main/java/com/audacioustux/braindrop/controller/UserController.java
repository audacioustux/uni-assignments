package com.audacioustux.braindrop.controller;

import com.audacioustux.braindrop.exception.ResourceNotFoundException;
import com.audacioustux.braindrop.model.User;
import com.audacioustux.braindrop.repository.UserRepository;
import com.audacioustux.braindrop.security.CurrentUser;
import com.audacioustux.braindrop.security.UserPrincipal;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
public class UserController {

    @Autowired
    private UserRepository userRepository;

    @GetMapping("/user/me")
    @PreAuthorize("hasRole('USER')")
    public User getCurrentUser(@CurrentUser UserPrincipal userPrincipal) {
        return userRepository.findById(userPrincipal.getId())
                .orElseThrow(() -> new ResourceNotFoundException("User", "id", userPrincipal.getId()));
    }
}
