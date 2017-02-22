#include <stdint.h>
#include <vector>
#include <iostream>
#include <stdlib.h>
#include <sstream>
#include <string>
#include <string.h>
#include <algorithm>
#include <array>
#include <functional>
#include <fstream>
#include <cstring>
#include <iomanip>

using namespace std;

ifstream indata;
ofstream outdata;

int hostname(string inp){
	
	char dot;
	int lent=0,countd=0,countl=0;
	lent=inp.size();
	
	for(int i=1;i<=lent;i++){
		
		dot = inp[i];
		
		if(dot == '.'){
			countd++;
		}
		
		else if(countd == 1)
		{
			countl++;
		}
		
		else if(countd == 2){
			break;
		}
		
	}
	
	return(countl);
	
	
	
}


int periodcount(string inp){
	
	char period;
	int le=0,countp=0;
	
	le = inp.size();
	
	for(int i = 1 ; i<=le;i++){
		
		period = inp[i];
		
		if(period == '.')
		{
			countp++;
		}
		
	}
	
	return(countp);
}

int domain_count(string inp){

	char c;
	int len=0,count=0;
	len = inp.size();

	for(int i=1;i<=len;i++){
		c = inp[i];

		if(c=='/'){
			return count-1;
			break;
		}

		else if (c=='.'){
			count++;
		}

		else if (i==len) {
		return count-1;
		}
	}
}

int ll_of_domain_token(string inp){
    int high = 0;
    istringstream iss(inp);
    vector<string> tokens;
    string token;
    while (getline(iss, token, '.')) {
        if (!token.empty())
            tokens.push_back(token);
    }
    for(int i=1; i<tokens.size()-1; i++){
        if(high<tokens[i].size()){
            high = tokens[i].size();
        }
    }
    return high;
}


int path_count(string inp){

	char cc;
	int lenp=0,count_slash=0;
	//count=0;
	//len=0;
	lenp = inp.size();

	for(int i=1;i<=lenp;i++){
		cc = inp[i];

		if (i==lenp){
			return count_slash;
			break;
		}

		else if (cc=='/'){
			count_slash++;
		}

	}
}

int path_attcount(string inp){
	
	
	char ch;
	int lens=0,count_att=0;

	lens = inp.size();
	
	for(int i=1;i<=lens;i++){
		ch = inp[i];

		if (i==lens){
			return count_att;
			break;
		}

		else if (ch=='='){
			count_att++;
		}

	}
	return count_att;
}


int main(){

	string inp;
	inp="0";
	cout<<"\nEnter the website to be checked:";
	cin>>inp;
	
	
    outdata.open("domaincount.csv",ios_base::app);
    outdata<<inp<<","<<hostname(inp)<<","<<inp.size()<<","<<periodcount(inp)<<","<<domain_count(inp)<<","<<ll_of_domain_token(inp)<<","<<path_count(inp)<<","<<path_attcount(inp)<<endl;
    outdata.close();
    
	return 0;

}

