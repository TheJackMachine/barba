# Barba

This plugin allows you to integrate Barba markup in your pages and manage namespaces. 

Barba is a Javascript library to « Create badass fluid and smooth transitions between your website’s pages. » ... without blocking search engines !
To know what is Barba you can visit https://barba.js.org/

If you want to create advanced transitions you need to implement the Barba structure in your page and manage namespaces. A namespace identify the type of your page and what transition, and/or what javascript functions need to be triggered when you call her.
But in october, each page is possibly a complex assembly of partials, layouts, pages and manage Barba namespaces can be a little confusing. For example declare variable in the code section of a page, and get it in the layout.. you know where i go ...

With this plugin, just add it, tel him the namespace, place the tags where you want the transition, « et voilà !»


 ## Usage
 
You can use it in two ways. 

 ### Maximum control way
 
 After installation you can use a component called Barba. You have also a new setting panel in your backend.
 
 First, add the barba plugin **in your layout page**
 
    [barba]

If the page have no namespace, the layout plugin will be the fallback.

Then, in the layout of the October demo theme add this barba tags :

    {% barba %}
    
        <!-- Html and other stuff here-->
        
    {% endbarba %}

For example :

    {% barba %}
        <!-- Header -->
        <header id="layout-header">
            {% partial 'site/header' %}
        </header>
    
        <!-- Content -->
        <section id="layout-content">
            {% page %}
        </section>
    
        <!-- Footer -->
        <footer id="layout-footer">
            {% partial 'site/footer' %}
        </footer>
    {% endbarba %}

Barba tags will add the Barba HTML code at the start and the end of your block. All the block between will be replaced by the  new page.
The plugin will use the container and wrapper partials

### Minimal way

Il you don’t want to define a block you can just add the component in the classical way :

    {% component 'barba' %}

The plugin will use the partial default.htm

### Then

Ok, your layout is ready, then go **in your page** and just add the Barba plugin with a namespace :

    [barba]
    namespace = 'home'
    
 you can add this on a other page with a different namespace, for example :
 
     [barba]
     namespace = 'contact'

and here, the magic happen. Your namespace will be set in the Barba tags, so you can trigger all you want and apply all the css you want with the Barba logic.

ok, maybe you think: **« hey Octobro! What happen if i don’t add the Barba plugin on my page ? »**
The plugin on the layout take care of it and add the default namespace called : **stdView** 

## Settings

For you convenience, i’ve add some settings.

1 - The default namespace, actually **stdView**.
You can change it to whatever you want.

2 - Loading Barba from CDN
If you want to load from the CDN, activate it. But if you use webpack and import Barba in your javascript to manage transition, for sure you don’t want that.

3 - Loading a minimal transition
... ok ... the lazy minute is ... now !
You want just see if the stuff work or see Barba in action ?
Activate the CDN, activate the minimal transition, and see a beautiful but ultra minimal fadein fadeout transition !

## Warning

If you use Barba, your site is considered like a single page by the analytics engine. Because the browser not reload the page entierly (all other pages is loaded in AJAX).
So, you need to manage analytics engine yourself ( dont’t worry it’s simple ! ).
To learn how to do that, check this page : https://barba.js.org/docs/userguide/analytics/

## Flexibility

If you don’t like default partials, no problem, just create barba folder in your partials theme folder and override the component default partials Container and Wrapper with yours.

I Hope you enjoy it !

And **welcome, in the JackMachine !** :)
