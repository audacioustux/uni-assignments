.MODEL SMALL
.DATA
msg1 db 'inorder: $'
msg2 db 'reverse: $'
msg3 db 'common: $'
nline db 0ah, 0dh, '$'

.CODE

MAIN PROC
  mov ax,@data
  mov ds,ax
  
  mov cl, 0
  input:
    mov ah, 1
    int 21h
    cmp al, 0Dh
    jne SKIPF
    call print4
    SKIPF:
    cmp al, 39h
    jg input
    sub al, 30h
    mov bx, ax
    and bx, 0Fh
    push bx
    inc cl
    
    cmp cl, 4
    jne SKIPR
    call print4
    SKIPR:
    
    jmp input
  
  main endp

   print4 proc
      pop dx
      mov ch, dl
      
      mov ah,2
      mov dl, 0ah
      int 21h
      mov dl, 0dh
      int 21h
      strvar:
        pop dx
        or bx, dx
        cmp cl, 1
        je print
          shl bx, 4
        loop strvar
      
      print:
      mov ah,9
      lea dx,msg2
      int 21h
      printrev:
        mov dl, bh
        shr dl, 4
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bh
        and dl, 0Fh
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bl
        shr dl, 4
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bl
        and dl, 0Fh
        add dl, 30h
        mov ah, 2
        int 21h
        
      mov ah,9
      lea dx, nline
      int 21h
      lea dx,msg1
      int 21h
      printin:
        mov dl, bl
        and dl, 0Fh
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bl
        shr dl, 4
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bh
        and dl, 0Fh
        add dl, 30h
        mov ah, 2
        int 21h
        
        mov dl, bh
        shr dl, 4
        add dl, 30h
        mov ah, 2
        int 21h
      
      mov ah,9
      lea dx, nline
      int 21h
      lea dx,msg3
      int 21h
        
      printCommon:
        mov cl, 1
        mov dl, bh
        mov ah, bh
        and ah, 0Fh
        shr dl, 4
        cmp dl, ah
        jne  sameskip1
        call same
        sameskip1:
        mov ah, bl
        shr ah, 4
        cmp dl, ah
        jne sameskip2
        or bl, 0F0h
        call same
        sameskip2:
        mov ah, bl
        and ah, 0Fh
        cmp dl, ah
        jne  sameskip3
        or bl, 0Fh
        call same
        sameskip3:
        
        cmp cl, 1
        je skipp1
        mov ah, 2
        add dl, 30h
        int 21h
        mov dl, ':'
        int 21h
        add cl, 30h
        mov dl, cl
        int 21h
        skipp1:
        
        ;;;;;;;;;;;
        mov cl, 1
        mov dl, bh
;        mov ah, bh
        and dl, 0Fh
;        shr dl, 4
;        cmp dl, ah
;        jne  sameskip1
;        call same
;        sameskip1:
        mov ah, bl
        shr ah, 4
        cmp dl, ah
        jne  sameskip22
        or bl, 0F0h
        call same
        sameskip22:
        mov ah, bl
        and ah, 0Fh
        cmp dl, ah
        jne  sameskip32
        or bl, 0Fh
        call same
        sameskip32:
        
        cmp cl, 
        je skipp2
        mov ah, 2
        add dl, 30h
        int 21h
        mov dl, ':'
        int 21h
        add cl, 30h
        mov dl, cl
        int 21h
        skipp2:
        
        ;;;;;;;;;;;;;;;;
        
        mov cl, 1
        mov dl, bl
        mov ah, bl
        and ah, 0Fh
        shr dl, 4
        cmp dl, 0Fh
        je sameskip13
        cmp dl, ah
        jne  sameskip13
        call same
        sameskip13:
        
        cmp cl, 1
        je skipp3
        mov ah, 2
        add dl, 30h
        int 21h
        mov dl, ':'
        int 21h
        add cl, 30h
        mov dl, cl
        int 21h
        skipp3:
        
        
        
    mov ah,2
    mov dl, 0ah
    int 21h
    mov dl, 0dh
    int 21h
    
    mov bx, 0    
    
    and cx, 00F0h
    push cx
    ret
    
    print4 endp
   
    same proc
      inc cl
      ret
    same endp
end main
