Hi! Welcome to the documentation of your site's Largo Project child theme. This has some documentation about what is needed to get up and running.

- Setting up the custom LESS to CSS Customizer (Theme version 0.2)
- Setting up hub pages with the new sidebar (Theme version 0.1)

# Setting up the custom LESS to CSS Customizer

This makes coloring many things in the site a lot easier.

1. In Appearance > Theme Options > Advanced, check "Enable Custom LESS to CSS For Theme Customization" and save.
2. In Appearance > CSS Variables, change the following:
	- Base Color: #268301
	- Color of links: #268301
	- Hover color of links: #268301
	- Sans Font Family: "Noto Sans", Arial, sans-serif
	- Serif font family: "PT Serif", Georgia, Times New Roman, serif
	- Sans font family: @serifFontFamily
3. Click "Save Variables"


# Setting up hub pages with the new sidebar

Do not be alarmed by the current appearance of your pages. They shall be fixed once you have followed these instructions:

## Create the Hub Topics Top and Hub Topics Bottom menus

These two menus appear on the sidebar of pages using the "Hub Generalized" topic. The reason there are two menus is to maintain a visual separation between the two.

1. Go to Appearance > Menus > Manage Locations
2. Find "Hub Topics Menu Top" or "Hub Topics Menu Bottom"
3. If the choice there is "-- Select a Menu --" click the "Use new menu" button.
4. Name the new menu "Hub Topics Menu Top" or "... Bottom" as appropriate
5. Add items to the menu using the search box at left. This is a hierarchical menu, so you cna scoot items left or right to indent them. Indented items will be bulleted, though there is not much space for them.
6. Be sure to hit "Save Menu"
7. Repeat for the other menu

It is possible to edit the names of links in this menu by clicking the "v" arrow next to "Page" in the link's box in the menu editor.

## Create the "Hub" sidebar

1. Go to Appearance > Widgets
2. In the list of widgets, click on "Custom Menu" and choose to add it to "Hub".
3. In the right-hand list of widget areas, a "Custom Menu" settings widget will appear.
	- title the widget whatever you wish to
	- From the "Select Menu" dropdown, choose "Hub Sidebar"
	- If you want the title to link to another page, type the link to that page in the "Widget Title Link" field.
4. In the the list of widgets, click on "Text" and add it to "Hub".
	- In the text box, paste this: `<div class="hub-logo"><a href="/hub/"><img src="http://3bhuf2134ms42er36k19to8ai.wpengine.netdna-cdn.com/files/2014/11/hub-logo-final.png"></a></div>`
	- Drag this widget to the top of the list.
5. Add other widgets, such as ad zones, in the same fashion.

If you want to have different sidebars for different pages, add the widgets to the appropriate sidebar. If you want to create additional sidebars, you can add them in Dashboard > Theme Options > Layout Options > Sidebar Options.

## Switch the /hub/ pages over to the new template.

The old pages will not automatically switch over to the new template. you will have to do this manually.

It's best to perform this work in tabs or in separate browser windows. If you keep the hierarchical list of pages open in one tab, and edit tabs in another, you can keep track of your progress.

1. Go to Dashboard > Pages.
2. Scroll down until you see "OST Research and Resource Hub"
3. Right-click on "Edit" under the title of the page. Choose "Open in new tab" or "Open in new window", depending on your preferences. 
4. In the right sidebar of the page editor:
	- Under "Page Attributes", choose the template "Hub Generic"
	- Under "Layout Options", choose the custom sidebar that is appropriate. If there is no appropriate sidebar, leave it on "Default" and the "Hub" sidebar will be used.
	- Click to the post's "Text" editor and make sure that no text is styled to have a certain color. If you see something like `<h3 style="color: #115301; font-family: 'Noto Sans', Lato, 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 24px; text-align: left;">`, remove the `color: #115301;` including the semicolon.

5. For each page in the listing after "OST Research and Resource Hub" that has a "-" before its name, repeat steps 3 and 4.



