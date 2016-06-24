# WebWiz v10 to bbPres Forum Converter

Place these two files into your WordPress `/wp-content/plugins/bbpress/includes/admin/converters` directory 
to make the `WebWiz10` converter available to bbPress under 'Tools', 'Forums', 'Import Forums'.

You will have to get your WebWiz forum data into MySQL before running the conversion. The bbPress convert
only works on MySQL data sources. The 'MySQL Workbench' worked for me in getting the data from MSSQL to MySQL.
Your results may vary.

Known Issues:
* Users must login to bbPress with a case-sensitive username their first time after the conversion.
* Does not convert private messages.
* Does not convert avatars.
* Does not convert signatures.
* Does not fix-up links to posts within posts.
* Pretends you have moved all previous images into `/webwiz/uploads`.
* Pretends you have copied WebWiz "smiley" images into `/webwiz/smileys`
