# Additional Compass plugins and import paths:
require 'ninesixty'
add_import_path "C:/Users/Corey/Documents/Web Design/Projects/Compass"

# Configuration settings:
http_path = "/"
relative_assets = true
css_dir = "css"
sass_dir = "src"
images_dir = "img"
javascripts_dir = "js"

# Output settings: :development || :production
environment = :development
output_style = (environment == :production) ? :compressed : :expanded
line_comments = (environment == :production) ? false : true
