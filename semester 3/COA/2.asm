.data
msg1 db 'input: $'
msg2 db 'inorder: $'
msg3 db 'reverse: $'
newl db 0ah, 0dh, '$'

.code
main proc
  mov ax, @data
  mov ds,ax
  
  mov ah, 9
  lea dx, msg1
  int 21h
  
  mov ah, 1
  int 21h  
  mov bh, al
  mov bl, bh
  
  mov ah, 9
  lea dx, newl
  int 21h
  
  mov cx, 8
  jcxz exit  
  
  
  inorder:
    lea dx, msg2
    int 21h
  inprtBit:
    rol bh, 1
    mov ah, 2
    jnc inprt0
    
    mov dl, '1'
    int 21h
    
    loop inprtBit
    jmp reverse
    
  inprt0:
    mov dl, '0'
    int 21h
    loop inprtBit
  
       
  reverse:
    mov cx, 8
    jcxz exit
    
    mov bh, bl
    mov ah, 9
    lea dx, newl
    int 21h
    lea dx, msg3
    int 21h
         
  revprtBit:
    ror bh, 1
    mov ah, 2
    jnc revprt0
    
    mov dl, '1'
    int 21h
    
    loop revprtBit
    jmp exit
    
  revprt0:
    mov dl, '0'
    int 21h
    loop revprtBit
   
  exit:
    mov ah, 4ch
    int 21h    

main endp
end main

