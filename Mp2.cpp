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


float al_of_domain_token(string inp){
    int sum = 0;
    float avg1;
    istringstream iss(inp);
    vector<string> tokens;
    string token;
    while (getline(iss, token, '.')) {
        if (!token.empty())
            tokens.push_back(token);
    }
    for(int i=1; i<tokens.size()-1; i++){
            sum += tokens[i].size();
    }
    float si = float(tokens.size()-2);
    avg1 = float(sum/si);
    return avg1;
}


float al_of_path_token(string inp){
    int sum = 0;
    float avg1;
    istringstream iss(inp);
    vector<string> tokens;
    string token;
    while (getline(iss, token, '/')) {
        if (!token.empty())
            tokens.push_back(token);
    }
    for(int i=1; i<tokens.size(); i++){
            sum += tokens[i].size();
    }
    float si = float(tokens.size()-2);
    avg1 = float(sum/si);
    if(avg1!=0){
        return avg1;
    }
    else{
        return 0;
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


int ll_of_path_token(string inp){
    int high = 0;
    istringstream iss(inp);
    vector<string> tokens;
    string token;
    while (getline(iss, token, '/')) {
        if (!token.empty())
            tokens.push_back(token);
    }
    for(int i=0; i<tokens.size()-1; i++){
        if(high<tokens[i].size()){
            high = tokens[i].size();
        }
    }
    if(high==0){
        high = inp.size();
    }
    return high;
}



int main(){

	string inp;
	string mystr1;
	inp="0";
	int num;
	float w[11],sumw=0,score;
	
	cout<<"Enter the value of weights:"<<endl;
	
	for(int j=1 ;j<11;j++ )
	{
		
		cout<<"W"<<j<<" = ";
		cin>>w[j];
		sumw =sumw + w[j];
		
	}
	
	cout<<"Enter number of URLs to be checked:"<<endl;
	cin>>num;
	cout<<"\nEnter URLs:";
	
	for(int i = 0; i < num ; i++){
	
	cin>>inp;
	
	
	string mystr = inp.substr(0, inp.find("/", 0));
	if(inp.find("?")<10000 && inp.find("/")<10000){
        int sub = inp.find("?", 0) - inp.find("/", 0);
        mystr1 = inp.substr(inp.find("/", 0)+1, sub-1);
	}
	else if(inp.find("/")<10000 && inp.find("?")>10000){
        mystr1 = inp.substr(inp.find("/", 0)+1, inp.size()-1);
	}
	else{
		mystr1 = inp;
	}
	
	score = (w[1]*hostname(inp) + w[2]*inp.size() + w[3]*periodcount(inp) + w[4]*domain_count(inp) + w[5]*path_count(inp) + w[6]*path_attcount(inp) + w[7]*al_of_domain_token(mystr) + w[8]*al_of_path_token(mystr1) + w[9]*ll_of_domain_token(mystr) + w[10]*ll_of_path_token(mystr1) )/(sumw);
	
	
    outdata.open("finalscore.csv",ios_base::app);
    outdata<<inp<<","<<hostname(inp)<<","<<inp.size()<<","<<periodcount(inp)<<","<<domain_count(inp)<<","<<path_count(inp)<<","<<path_attcount(inp)<<","<<al_of_domain_token(mystr)<<","<<al_of_path_token(mystr1)<<","<<ll_of_domain_token(mystr)<<","<<ll_of_path_token(mystr1)<<","<<score<<endl;
    outdata.close();



	}

	return 0;

}


