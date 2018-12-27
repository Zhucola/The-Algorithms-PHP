#include<stdio.h>
int BubbleSort(int arr[],int len);
void swap(int *arr1,int *arr2);
int main(){
	int arr[] = {3,5,7,11,32,4,1,78,95,23,14,6};
	int len = sizeof(arr)/sizeof(arr[0]);
	BubbleSort(arr,len);
	for(int i=0;i<len;i++){
		printf("%d\n",arr[i]);
	}
}
int BubbleSort(int arr[],int len){
	for(int x = 0;x<len-1;x++){
		for(int y=0;y<len-x-1;y++){
			if(arr[y] > arr[y+1]){
				swap(&arr[y],&arr[y+1]);
				/*
				int temp = arr[y];
				arr[y] = arr[y+1];
				arr[y+1] = temp;
				*/
			}
		}
	}
}
void swap(int *arr1,int *arr2){
	int temp = *arr1;
	*arr1 = *arr2;
	*arr2 = temp;
}
