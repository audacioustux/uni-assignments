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
      xor dl, 0FFh
      and dl, 0Fh
      mov ah, 2
     cmp dl, 0Ah
         jl add302
         add dl, 41h
         sub dl, 0ah
         jmp j1
         add302:
          add dl, 30h
         j1:
      int 21h
      
      mov dl, bl
      shr dl, 4
      xor dl, 0FFh
      and dl, 0Fh
      mov ah, 2
      cmp dl, 0Ah
         jl add301
         add dl, 41h
         sub dl, 0ah
         jmp j2
         add301:
          add dl, 30h
         j2:
      int 21h
      
      mov dl, bh
      and dl, 0Fh
      xor dl, 0FFh
      and dl, 0Fh
      mov ah, 2
      cmp dl, 0Ah
         jl add303
         add dl, 41h
         sub dl, 0Ah
         jmp j3
         add303:
          add dl, 30h
         j3:
      int 21h
      
      mov dl, bh
      shr dl, 4
      xor dl, 0FFh
      and dl, 0Fh
      mov ah, 2
      cmp dl, 0Ah
         jl add304
         add dl, 41h
         sub dl, 0Ah
         jmp j4
         add304:
          add dl, 30h
         j4:
      int 21h
      
      
  main endp
     
end main
