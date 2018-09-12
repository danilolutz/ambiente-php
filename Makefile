setup:
	docker-compose pull
	docker-compose build
	docker-compose up -d
	cp pre-commit-hook .git/hooks/pre-commit
	chmod +x .git/hooks/pre-commit
