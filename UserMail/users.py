#get userlist from text and prepare them for mass email for using on laravel
file = open('userlist.txt')

users = file.readlines()
output = open('output.txt','w')

i= 0
while i < len(users):
	output.write('php artisan user:send --email="' + users[i].strip() + '"\n')
	i += 1


