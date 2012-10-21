# Additional Compass plugins and import paths:
require 'susy'
require 'compass-h5bp'

# Configuration settings:
http_path       = "/"
relative_assets = true
css_dir         = "css"
sass_dir        = "src"
images_dir      = "img"
javascripts_dir = "js"

# Output settings: :development || :production
environment     = :development
output_style    = ( environment == :production ) ? :compressed : :expanded
line_comments   = ( environment == :production ) ? false : true
sass_options    = ( environment == :production ) ? {} : { :debug_info => true }
