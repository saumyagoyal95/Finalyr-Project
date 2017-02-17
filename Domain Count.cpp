#include<iostream>
#include<cstring>
#include <fstream>
#include<string>
#include <iomanip>

using namespace std;

int main(){
	
	string inp;
	int len=0,count=0,num=0;
	ifstream indata;
	ofstream outdata;
	
	
	cout<<"Enter the number of websites to be checked:";
	cin>>num;
	
	char c;
	
	for(int j=0;j<num;j++){
	
	count=0;
	inp="0";
	len=0;
	cin>>inp;
	len = inp.size();
	
	for(int i=1;i<=len;i++){
		
	
		c = inp[i];
		
		if(c=='/'){
			
			cout<<count-1<<endl;
			outdata.open("domaincount.csv",ios_base::app);
			outdata<<inp<<","<<count-1<<endl;
			outdata.close();
			break;
			
		}
		
		else if (c=='.'){
			
			count++;
			
		}	
		
		else if (i==len) {
		cout<<count-1<<endl;
		
		outdata.open("domaincount.csv",ios_base::app);
		outdata<<inp<<","<<count-1<<endl;
		outdata.close();
		}
		
		
	}
	}
	return 0;
	
}
