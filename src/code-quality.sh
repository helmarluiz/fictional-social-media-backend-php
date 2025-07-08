#!/bin/sh

# DEPRECATED: This script has been replaced by composer scripts
# Use the following composer commands instead:
#   composer run quality:phploc     - Lines of code analysis
#   composer run quality:phpstan   - Static analysis
#   composer run quality:phpmd     - Mess detector
#   composer run quality:phpcpd    - Copy paste detector
#   composer run quality:phpmetrics - Metrics with HTML reports
#   composer run quality:all       - Run all quality tools
#
# See README.md for detailed usage instructions

exit 0

# OLD CODE BELOW - COMMENTED OUT
#
# BASEDIR=$(dirname "$0")
# 
# echo "Running code quality checks";
# 
# #echo "1 - PHPLoc Lines of code static analysis to find PHP code smells";
# #docker run -it --rm -v "$PWD":/app -w /app adamculp/php-code-quality:latest \
# #php /usr/local/lib/php-code-quality/vendor/bin/phploc  \
# #--exclude vendor . > "$BASEDIR"/logs/phploc.txt
# 
# 
# echo "2 - PHP Static Analysis Tool - discover bugs in your code without running it";
# docker run -it --rm --name php-code-qualityy -v "$PWD":/app -w /app \
# adamculp/php-code-quality:latest sh -c "php /usr/local/lib/php-code-quality/vendor/bin/phpstan \
# analyse -l 0 --error-format=table > $BASEDIR/logs/phpstan_results.txt ."
# 
# #echo "3 - PHPMD - PHP Mess Detector";
# #docker run -it --rm -v "$PWD":/app -w /app adamculp/php-code-quality:latest \
# #php /usr/local/lib/php-code-quality/vendor/bin/phpmd . xml \
# #codesize,cleancode,controversial,design,naming,unusedcode \
# #--exclude 'vendor' \
# #--reportfile "$BASEDIR/logs/phpmd_results.xml"
# 
# #echo "4 - Php Copy Paste Detector";
# #docker run -it --rm -v "$PWD":/app -w /app adamculp/php-code-quality:latest \
# #php /usr/local/lib/php-code-quality/vendor/bin/phpcpd . \
# #--exclude 'vendor' > $BASEDIR/logs/phpcpd_results.txt
# 
# 
# #echo "5 - PhpMetrics is a static analysis tool for PHP";
# #docker run -it --rm -v "$PWD":/app -w /app adamculp/php-code-quality:latest \
# #php /usr/local/lib/php-code-quality/vendor/bin/phpmetrics --excluded-dirs 'vendor' \
# #--report-html=$BASEDIR/logs/metrics_results .





