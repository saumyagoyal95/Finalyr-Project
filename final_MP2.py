def hostname(inp):

    url = inp
    hlen = url.split('.')[1]
    print "hostname length is",len(hlen)

    return len(hlen);

def domaincount(inp):

    url = inp
    slashsplit = url.split('/')[0]
    dlist = slashsplit.split('.')
    print "domain count is",len(dlist)-2

    return len(dlist)-2;



def periodcount(inp):

    count=0
    count = inp.count(".")
    print "period count is ", count

    return count;

def path_attr(inp):
    count = 0
    count = inp.count("=")
    print "path attribute count is ",count

    return count;

def path_count(inp):
    count = 0
    count = inp.count("/")

    if count>1:
        print "path count is ",count-1
        return count-1;
    else:
        print "path count is",count
        return count;

def al_path_token(inp):

    paths = []
    url = inp
    pathsplit = url.split('/')
    avgp=0

    if (len(pathsplit)>1):
            paths = pathsplit[1:len(pathsplit)-1]

            if len(paths)>1:
                avgp = float(sum(map(len, paths))) / len(paths)
                print "average path token count is",avgp
    else:
        avgp=0
        print"avggg"
        print "average path token count is", avgp

    return avgp;

def ll_path_count(inp):

    maxi=0
    paths = []
    url = inp
    pathsplit = url.split('/')

    if (len(pathsplit) > 1):

        paths = pathsplit[1:len(pathsplit) - 1]

        if len(paths)>1:
            maxi = max(map(len, paths))
            print "longest length of path token is", maxi


    else:
        maxi=0
        print "maaaaxi"
        print "longest length of path token is", maxi

    return maxi;

def avgl_domain_token(inp):

    paths = []
    url = inp
    pathsplit = url.split('.')

    lensplit = len(pathsplit)
    lastdsplit = pathsplit[lensplit-2]
    lastd = lastdsplit.split('/')[0]

    paths = pathsplit[2:len(pathsplit) - 2]
    paths.append(lastd)

    avgp = float(sum(map(len, paths))) / len(paths)
    print "average domain token count is", avgp

    return avgp;

def ll_domain_count(inp):

    paths = []
    url = inp
    pathsplit = url.split('.')

    lensplit = len(pathsplit)
    lastdsplit = pathsplit[lensplit - 2]
    lastd = lastdsplit.split('/')[0]

    paths = pathsplit[2:len(pathsplit) - 2]
    paths.append(lastd)

    print "longest length of domain token is",max(map(len,paths))

    return max(map(len,paths));

def len_of_url(inp):

    lenth = len(inp)
    print "Length of URL is" , lenth

    return lenth;



url_input = raw_input("Enter the URL:")

w1_hname = hostname(url_input)
w2_pcount = periodcount(url_input)
w3_pattc = path_attr(url_input)
w4_dcount = domaincount(url_input)
w5_path = path_count(url_input)
w6_avgpath = al_path_token(url_input)
w7_llpath = ll_path_count(url_input)
w8_avgdomain = avgl_domain_token(url_input)
w9_lldomain = ll_domain_count(url_input)
w10_len = len_of_url(url_input)
