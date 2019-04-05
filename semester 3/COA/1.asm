.data 
msg3 db 0Dh,0Ah,'$'
msg4 db 'wrong input $'
 
.code
main proc      
    mov ax,@data
    mov ds,ax
      
    mov ah, 1
    
    mov bl, 00h
    mov bh, 00h
    
    mov cx, 0h
      
    input:
      cmp cl, 16
      je exit
      
      int 21h
     
      cmp al, 0dh
      je print
      
      inc cx
      sub al, 30h
      
      cmp cx, 8
      
      je shlBl
      jl shlBl  
      jg shlBh
      
      shlBh:
        shl bh, 1
        jmp jumpbla
      shlBl:
        shl bl, 1
      
      jumpbla:
      
      cmp al, 1h
      je push1
      cmp al, 0h
      jne wrInput
      
      jmp input
        
      
    push1:
      cmp cx, 8
      jg strh
      or bl, al

      jmp input
      
      strh:
        or bh, al
        jmp input
   
    
    mov ah,9
    lea dx,msg3
    int 21h
    
    print:
      mov ah, 2
      mov dl, 0Ah
      int 21h
      mov dl, bl
      int 21h
      cmp cl, 8
      jg prth
      jmp exit
      prth:
        mov dl, bh
        int 21h
    
    jmp exit     
    
    wrInput:
      mov ah,9
      lea dx,msg4
      int 21h
      
    exit:
    mov ah,4ch
    int 21h 

main endp
end main  
