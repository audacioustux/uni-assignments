// Number Conversion: Convert from any base to decimal and vice versa
// Given a number and its base, convert it to decimal. The base of number can be anything such that all digits can be represented using 0 to 9 and A to Z. For example, the Value of A is 10, and the value of B is 11 and so on. Students will use functions for implementing this program in C whereas in C++ it will be implemented using CLASS.
// কোড মোটেও কপি করা না :')
// এরর দেখাইলে -lm flag দিয়ে রান করা লাগবে।

#include<stdio.h>
#include<string.h>
#include<math.h>

#define MAX_LEN 80
typedef enum { false, true } bool;

int char2int(char a){
    if(a >= 48 && a <= 57){
        return a - 48;
    } else if (a >= 65 && a <= 90){
        return 9 + a - 64;
    } else if (a >= 97 && a <= 122){
        return 9 + a - 96;
    } else {
        return -1;
    }
}
int main()
{
    char number[MAX_LEN];
    unsigned int base, number_len;
    double dec_value;
    char *fraction_ptr;
    int fraction_at = -1, case_no = 1, temp_no;
    bool error;

    while(1){
        dec_value = 0;
        error = false;
        printf("%d. ", case_no);
        case_no++;
        printf("Enter number to convert (with no space): ");
        scanf("%s", &number);
        printf("Enter Base: ");
        scanf("%d", &base);
        if(base > 35){
            printf("Base out of range!\n");
            continue;
        }
        number_len = strlen(number);
        fraction_ptr = strrchr(number,'.');
        if(fraction_ptr) 
            fraction_at = fraction_ptr - number;
        else
            fraction_at = number_len;
        for(int i = 0; i < number_len; i++){
            if(number[i] == '.'){
                fraction_at++;
            } else {
                temp_no = char2int(number[i]);
                if(temp_no != -1)
                    if(!(temp_no >= base))
                        dec_value += temp_no * pow (base, fraction_at-i-1);
                    else{
                        error = true;
                        printf("Character Out of Base Range!\n");
                        break;
                    }
                else{
                    error = true;
                    printf("Invalid Character!\n");
                    break;
                }
            }
        }
        if(error)
            continue;
        printf("%f\n", dec_value);
    }
    
    return 0;
}
