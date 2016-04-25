Файлы конфига для Git
	
	В состав Git входит утилита git config, которая позволяет просматривать и устанавливать параметры, контролирующие все аспекты работы Git и его внешний вид. Эти параметры могут быть сохранены в трёх местах:

	Файл /etc/gitconfig содержит значения, общие для всех пользователей системы и для всех их репозиториев. Если при запуске git config указать параметр --system, то параметры будут читаться и сохраняться именно в этот файл.
	Файл ~/.gitconfig хранит настройки конкретного пользователя. Этот файл используется при указании параметра --global.

	Конфигурационный файл в каталоге Git (.git/config) в том репозитории, где вы находитесь в данный момент. Эти параметры действуют только для данного конкретного репозитория. Настройки на каждом следующем уровне подменяют настройки из предыдущих уровней, то есть значения в .git/config перекрывают соответствующие значения в /etc/gitconfig.

	В системах семейства Windows Git ищет файл .gitconfig в каталоге $HOME (C:\Documents and Settings\$USER или C:\Users\$USER для большинства пользователей). Кроме того Git ищет файл /etc/gitconfig, но уже относительно корневого каталога MSys, который находится там, куда вы решили установить Git, когда запускали инсталлятор.
	
Настройки пользователя в Git	

	$ git config --global user.name "John Doe"
	$ git config --global user.email johndoe@example.com

Просмотр Настроек

	$ git config --list

Просмотр Настроек определленой опции

	git config user.name