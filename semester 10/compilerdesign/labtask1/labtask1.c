#include <stdio.h>
#include <string.h>

void task1(){
    int i,n,sum=0;
   
    printf("Enter size of the array : ");
    scanf("%d",&n);
    
    int a[n];

    printf("Enter elements in array : ");
    for(i=0; i<n; i++)
    {
        scanf("%d",&a[i]);
    }
 
    for(i=0; i<n; i++)
    {
         
        sum+=a[i];
    }
    printf("sum of array is : %d\n",sum);
}

void task2() {
    int i,n,max, min;
   
    printf("Enter size of the array : ");
    scanf("%d",&n);
 
    int a[n];

    printf("Enter elements in array : ");
    for(i=0; i<n; i++)
    {
        scanf("%d",&a[i]);
    }
 
    max = a[0];
    min = a[0];
    for(i=1; i<n; i++)
    {
        int val = a[i];
        if(max < val) { max = val; }
        if(min > val) { min = val; }
    }
    printf("maximum : %d\n", max);
    printf("minimum : %d\n", min);
}

void task3() {
    char firstname[1000], lastname[1000];
    scanf("%s %s", firstname, lastname);
    printf("%s", strcat(strcat(firstname, " "), lastname));
}

int main(void){
    // task1();
    // task2();
    task3();
    return 0;
}
