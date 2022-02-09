<?php

use Joomla\CMS\Categories\Categories;


class ModVerticalTimeline
{
    /**
     * Retrieves the hello message
     *
     * @param array $params An object containing the module parameters
     *
     * @access public
     */
    public static function getCategoryChilds(&$params)
    {
        $db = JFactory::getDbo(); //Returns a database object.
        // Get an instance of the generic articles model

        $articles = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
        //JModelLegacy == Acts as a Factory class for application specific objects and provides many supporting API functions.
        //getInstance == Returns a Model object, always creating it
        // Set application parameters in model

        $articles->setState(
        //The CASE statement goes through conditions and returns a value when the first condition is met (like an if-then-else statement)
            'list.select',
            'a.id, a.title, a.alias, a.introtext, a.fulltext, ' .
            'a.checked_out, a.checked_out_time, ' .
            'a.catid, a.created, a.created_by, a.created_by_alias, ' .
            // use created if modified is 0
            'CASE WHEN a.modified = ' . $db->q($db->getNullDate()) . ' THEN a.created ELSE a.modified END as modified, ' .
            'a.modified_by, uam.name as modified_by_name,' .
            // use created if publish_up is 0
            'CASE WHEN a.publish_up = ' . $db->q($db->getNullDate()) . ' THEN a.created ELSE a.publish_up END as publish_up,' .
            'a.publish_down, a.images, a.urls, a.attribs, a.metadata, a.metakey, a.metadesc, a.access, ' .
            'a.hits, a.xreference, a.featured'
        );//setState ==Method to set model state variables. mixed The previous value of the property???

        $app = JFactory::getApplication();// Returns the JApplicationCMS, through it you can access for the example do redirects, access the configuration and the input variables, the Menu or enqueue messages which are shown to the user
        $appParams = $app->getParams();//Gets the parameter object for the component.

        $articles->setState('params', $appParams);
        // Set the filters based on the module params
        $articles->setState('list.start', 0);
        // $articles->setState('list.limit', (int) $params->get('count', 0));
        $articles->setState('filter.published', 1);

        // This module does not use tags data
        $articles->setState('load_tags', false);
        // Filer by tag
        $articles->setState('filter.tag', $params->get('tag', array()));

        // Access filter
        $access = !JComponentHelper::getParams('com_content')->get('show_noauth');//Component helper class and get
        $authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));//Class that handles all access authorisation routines.
        $articles->setState('filter.access', $access);

        // Category filter
        $catids = $params->get('catid');
        if ($catids != null) {
            if ($params->get('show_child_category_articles', 0) && (int)$params->get('levels', 0) > 0) {
                // Get an instance of the generic categories model
                $categories = JModelLegacy::getInstance('Categories', 'ContentModel', array('ignore_request' => true));
                $categories->setState('params', $appParams);
                $levels = $params->get('levels', 1) ? $params->get('levels', 1) : 9999;
                $categories->setState('filter.get_children', $levels);
                $categories->setState('filter.published', 1);
                $categories->setState('filter.access', $access);
                $additional_catids = array();

                foreach ($catids as $catid) {
                    $categories->setState('filter.parentId', $catid);
                    $recursive = true;
                    $items = $categories->getItems($recursive);//mixed An array of data items on success, false on failure.

                    if ($items) {
                        foreach ($items as $category) {
                            $condition = (($category->level - $categories->getParent()->level) <= $levels);
                            if ($condition) {
                                $additional_catids[] = $category->id;
                            }

                        }
                    }
                }

                $catids = array_unique(array_merge($catids, $additional_catids));
                //array_unique — Removes duplicate values from an array
                //array_merge — Merge one or more arrays
            }
            $articles->setState('filter.category_id', $catids);

            // Ordering
            $articles->setState('list.ordering', $params->get('article_ordering', 'a.ordering'));
            $articles->setState('list.direction', $params->get('article_ordering_direction', 'ASC'));

// 		// New Parameters
            $articles->setState('filter.featured', $params->get('show_front', 'show'));

            // Filter by language

            $articles->setState('filter.language', $app->getLanguageFilter());

            $items = $articles->getItems();

            return $items;
        }
    }

}
