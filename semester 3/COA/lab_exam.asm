; for input 'C' output CAAC
.MODEL SMALL
.DATA
msg1 db 'bin: $'
msg2 db 'hex: $'
nline db 0ah, 0dh, '$'

.CODE

MAIN PROC
  mov ax,@data
  mov ds,ax
  
  mov ah, 1
  int 21h
  cmp al, 40h
  jl sub30
  sub al, 60h
  add al, 9h
  jmp oo1
  sub30:
    sub al, 30h
  oo1:
  
  mov cl, al
  mov ch, al
  
  and ax, 0fh
  and dx, ax
  
  shl cl, 4
  mov ah, cl
  
  or dx, ax
  
  sub ch, 2
  
  mov cl, ch
  shl cl, 4
  
  or dx, cx
  
  
  ;call printDX
   
      
  main endp

  ;printDX proc
;    mov ah,9
;    lea dx, nline
;    int 21h
;    lea dx, msg1
;    int 21h
;    
;    mov cx, 16
;    
;    bitPrint:
;      shl dx, 1
;      mov ah, 2
;      jc prt1:
;      mov dl, '0'
;      int 21h
;      jmp oo2 
;      prt1:
;       mov dl, '1'
;       int 21h    
;      oo2:
;      
;      loop bitPrint
      
end main
