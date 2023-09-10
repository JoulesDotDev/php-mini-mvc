# Simple MVC Structure

## Writen in pure PHP
- Vanilla PHP
- No dependencies
- Except PHPMailer for email sending
- Easy to change if needed

## Features
- MVC
- Validation
- JWT + Blacklisting
- User profiles
- Email + Email Verification
- Password reset
- CSRF Protection
- Middleware
- MySQL Connection
- Logger
- Easy to load views and components

## Roadmap
- Rate limiting (optional)
- HTMX + AlpineJS + TailwindCSS (+daisyui) Branch
- ORM Branch

# Docs

### Config Folder
- Contains everything needed to run the app
- Database Connection
- Email/SMTP Config
- Environment Variables
- Headers
- Runtime variables to make reading data easier
- Secrets and Keys
- Global Utils importer

### Controllers
- Actions that can be called from the router for every route (see Routes.php)
    - Structure is based on GET and POST requests only
        - POST requests forms send an ACTION with them
        - If it's neither GET or POST with ACTION, it's a 405
        - If the action doesn't exist it's a 404
    - Can be either a PHP file or a folder with an index.php file, see Controller/Utils/Routing/Router.php
- Middleware Files
- Utils Foler
    - Data
        - Utils related to reading and writing data
        - Helpers for JWT and Cookies
        - Flash for transfering data between pages/requests
        - Logger
        - Reading of GET and POST Params
        - A _CONTEXT object to move data from Middleware to Controllers to Views
        - Password Hasing
    - Responses
        - JSON Response helper
        - Redirect helper
    - Routing
        - Router.php takes care of finding Controllers based on paths
        - Routing.php has a static class used to define Routes and pair them with Middleware
- Routes.php defines all the routes and middleware to be used per route or globally
    - Uses the Routing static class
    - Global middleware should be set first, it sets middleware for all routes after it was called

### Email
- Templates files in HTML
- Email static class to send individual emails
- SMTP Connection manager
- Tempalte builder that simply fills placeholders

### Exceptions
- Custom Exceptions for easier bug hanlding

### Logs
- Error logs, usually thrown from exceptions
- Info logs, for debugging or seeing what requests come in
- Simple logs, for quick debugging

### Models
- Traits folder for helpers i.e. Special filtered reading of data
- DB.php takes care of the DB connection
- Utils contains models for things like Tokens
- Models can be a PHP file or a folder to split up things better

### Tasks
- Load.php starts the runtime variables for tasks
- Task files can be called from the CLI or a Cronjob

### Vendor
- Contains external libraries

### Views
- Components
    - Folder for shared components, can be filed or Folders to sort them
    - Called via Component("Popup/Example"), it will look in the Views/Component/ folder automatically
    - It's recommended to put Shared in the name, they can be shadowed by local components
    - By default the component will be searched for in the Components/ folder of the current page
    - To prevent shadowing and use the shared components you can start the path with a /
- Pages
    - A page can be a PHP file or a folder with an index.php when using a Components/ folder
    - The pages returned from the controller when a request is made
    - Called via View() when the page path is the same as the Controller path
    - Called with View("Example/Signup") when the name is different

- Utils
    - LoadFields.php is a helper for special form fields, like action and the csrf token
    - LoadTemplates.php contains the View() and Component() functions
    - Output.php contains the __() function for escaping HTML output

### Other
- Common .htaccess file for a single entry point
- index.php to start the app, load the config files and create the router
