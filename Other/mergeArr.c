#include<stdio.h>
void mergeArr(int a[],int len_a,int b[],int len_b,int res[]){
	int x,y,z = 0;
	while(x<len_a && y < len_b){
		if(a[x] < b[y]){
			res[z++] = a[x++];
		}else{
			res[z++] = b[y++];
		}
	}
	while(x < len_a){
		res[z++] = a[x++];
	}
	while(y < len_b){
		res[z++] = b[y++];
	}
}
void printArr(int res[],int len){
	int i;
	for(i=0;i<16;i++){
		printf("%d\n",res[i]);
	}
}
int main(){
	int a[7] = {1,3,5,7,11,23,76};
	int b[9] = {2,3,6,7,11,13,56,123,678};
	int res[16] = {};
	mergeArr(a,7,b,9,res);
	printArr(res,16);
}
