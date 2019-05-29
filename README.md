# incredibletheme
WordPress theme for custom builds.

## Assets
* [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/)
* [Swiper](http://idangero.us/swiper/api/)
* [Font Awesome 5 Pro](https://fontawesome.com/)
* [TweenMax](https://greensock.com/docs/TweenMax)
* [ScrollMagic](http://scrollmagic.io/)

## Installation
Follow these steps to get up and running with the included Plugins and Custom Fields installed and synced correctly.

### Install Theme
![download](https://user-images.githubusercontent.com/36015859/41052239-dc588f1a-697d-11e8-8561-60c1ceb25cd4.png)
1) Download zip of the the master branch
2) Rename the folder `incredibletheme` and re-zip
3) Upload and activate `incredibletheme.zip` in your new WordPress install

### Install Plugins
After activating the theme, you will see a message with required and recommended plugins.

1. Click Begin Installing Plugins
2. Check all plugins
2. Select Bulk Actions > Install
3. Click Apply

![install-plugins](https://user-images.githubusercontent.com/36015859/41052777-605df77c-697f-11e8-8cdd-07fb8768abf5.gif)

### Sync ACF Fields
This theme comes packaged with several pre-built custom Field Groups via ACF Pro. After activating incredibletheme and Advanced Custom Fields Pro, these fields are automatically imported, **however if you edit any of them without syncing first, it treats your edits as NEW fields resulting in duplication issues**.

To avoid this, **sync the existing field groups before changing any fields**:
1. Go to Custom Fields
2. Click Sync available
3. Check all field groups
4. Select Bulk Actions > Sync
5. Click Apply

![sync](https://user-images.githubusercontent.com/36015859/41048997-8a8319a6-6975-11e8-88f5-48e63734b6d5.gif)

At this point you should have `incredibletheme` installed with all custom field groups imported and synced. Moving forward you should be able to edit anything you want without issue.


### Using Gulp
The Gulp tools in this build allow you to use sass, imagemin, js min/concat and js/css linters for errors. CSS media queries are also combinded for shorter code. Follow the steps below to get started!

1. Install [Node.js](https://nodejs.org/en/) and [Gulp](https://gulpjs.com/)
2. cd to your project and run `npm install`.
3. Go to line 13 in gulpfile.js and update to reflect your local setup.
4. Run "gulp" from your project root.
5. If this is your first time running gulp or you are getting the error "Command Not Found" when trying to run 'gulp', run this command:
   'npm install --global gulp-cli'
   This will install all the Gulp Command Line Tools needed to use Gulp. You will only have to do this once as it installs it globally to your machine.


## Plugin resources

Licenses, addons, etc.

* [Advanced Custom Fields Pro](https://podio.com/incrediblemarketingcom/dev-area-2/apps/dev-assets/items/11)
* [Font Awesome 5 Pro](https://podio.com/incrediblemarketingcom/dev-area-2/apps/dev-assets/items/30)
* [Gravity Forms](https://podio.com/incrediblemarketingcom/dev-area-2/apps/dev-assets/items/35)
* [WPMU Dev Dashboard](https://podio.com/incrediblemarketingcom/dev-area-2/apps/dev-assets/items/16)
