.MODEL SMALL
.DATA
.CODE

MAIN PROC
  mov cl, 0
  input:
    mov ah, 1
    int 21h
    cmp al, 0Dh
    je exit
    cmp al, 39h
    jg input
    sub al, 30h
    mov bx, ax
    and bx, 0Fh
    push bx
    inc cl
    
    jmp input
    
  EXIT:
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
    mov ah, 4ch
    int 21h  

end main
