package com.audacioustux.braindrop.payload;

import javax.validation.constraints.NotBlank;

import com.audacioustux.braindrop.model.AuthProvider;

import lombok.Data;

@Data
public class DropRequest {
    @NotBlank
    private String content;
    @NotBlank
    private AuthProvider provider;
    @NotBlank
    private String providerUsername;
}
