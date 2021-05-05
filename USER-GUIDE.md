## Documentation

- Installation guide: https://blog.landofcoder.com/install-magento-2-extension/#solution-1-ready-to-paste
- User Guide: 
- Product page: https://landofcoder.com/magento-2-instagram-feed.html/
- FAQs: https://landofcoder.com/faq/
- Get Support: https://landofcoder.com/contacts or info@landofcoder.com
- Changelog: 
- License agreement: https://landofcoder.com/license

## How to install

### Install ready-to-paste package (Recommended)

- Installation guide: https://blog.landofcoder.com/install-magento-2-extension/

## How to upgrade

1. Backup

Backup your Magento code, database before upgrading.

2. Remove InstagramFeed folder

In case of customization, you should backup the customized files and modify in newer version.
Now you remove `app/code/Lof/InstagramFeed` folder. In this step, you can copy override InstagramFeed folder but this may cause of compilation issue. That why you should remove it.

3. Upload new version
Upload this package to Magento root directory

4. Run command line:

```
php bin/magento setup:upgrade
php bin/magento setup:static-content:deploy
```


## FAQs

#### Q: My site is down
A: Please follow this guide: https://blog.landofcoder.com/magento-site-down.html


## Support

- FAQs: https://landofcoder.com/faq/
- https://ticksy.landofcoder.com/
- info@landofcoder.com
