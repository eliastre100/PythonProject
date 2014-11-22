PythonProject
=============

Project to help organisation during ISN (Informatique et sciences du numérique) or script projects

1] Install
----------

1. Clone project
2. Update vendors with composer

		php composer.phar install

3. Rename /app/config/parameters.yml.dist to parameters.yml if it wasn't create during composer installation
4. Change Secret
5. Set Cache and log 777
6. Generate database
		php app/console doctrine:database:create
		php app/console doctrine:schema:update --force

2] Certifications
----------

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d96399b1-5c10-40d3-ba04-2f16f5337a88/mini.png)](https://insight.sensiolabs.com/projects/d96399b1-5c10-40d3-ba04-2f16f5337a88)
[![Build Status](https://travis-ci.org/eliastre100/PythonProject.svg)](https://travis-ci.org/eliastre100/PythonProject)
