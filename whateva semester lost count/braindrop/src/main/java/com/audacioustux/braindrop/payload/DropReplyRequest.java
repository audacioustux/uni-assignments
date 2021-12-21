package com.audacioustux.braindrop.payload;

import javax.validation.constraints.NotBlank;

import com.audacioustux.braindrop.model.Drop;

import lombok.Data;

@Data
public class DropReplyRequest {
    @NotBlank
    private String content;
    @NotBlank
    private Drop repliedTo;
}
