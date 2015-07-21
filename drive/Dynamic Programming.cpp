#include<iostream>

using namespace std;

int fibo( int n );
int fiboDP( int n );

int count = 0;
int DPcount = 0;
int fiboAns[101];

int main()
{
	int n;
	
	cin >> n;
	
	cout << "Normal : fibo(" << n << ") = " << fibo( n );
	cout << "  Count : " << count;
	
	cout << endl;
	
	cout << "DP     : fibo(" << n << ") = " << fiboDP( n );
	cout << " Count : " << DPcount;
	
	
	
	
	return 0;
}

int fibo( int n )
{
	count++;
	
	if( n < 2 )
		return 1;
	else
		return fibo( n-1 ) + fibo( n-2 );	
}


int fiboDP( int n )
{
	DPcount++;
	
	if( n < 2 )
		return 1;
	else
	{
		if( fiboAns[n-1] == 0 )				//If NOT already counted... 
			fiboAns[n-1] = fiboDP( n-1 );
			
		if( fiboAns[n-2] == 0 )				//If NOT already counted...
			fiboAns[n-2] = fiboDP( n-2 );
			
		return fiboAns[ n-1 ] + fiboAns[ n-2 ];
	}
}
