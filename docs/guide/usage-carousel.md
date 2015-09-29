# Using the Bootstrap Carousel Yii2 Widget #
The Bootstrap carousel is a widely used widget that rotates a set of images across a fixed area, often seen at the top of a site's home page.

You can see the Bootstrap Documentation [here](http://getbootstrap.com/javascript/#carousel)

Like the other Bootstrap widgets, Yii2 provides a widget that means you don't have to write the markup directly but can simply populate the widget fields as
shown in the example below.

## Example ##

```
Carousel::widget([
      'controls' => ['<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>', '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>'],
      'showIndicators' => true,
      'items' => [
          [
              'content' => '<img src="" data-src="holder.js/1170x300?random=yes" alt="" />',  // required
              'caption' => '<h4>Slide 1</h4><p>Jobby is sweet...</p>', // optional
              'options' => [],
          ],
          [
              'content' => '<img src="" data-src="holder.js/1170x300?random=yes" alt="" />',  // required
              'caption' => '<h4>Slide 2</h4><p>...dont you know</p>',
              'options' => [],
          ],
      ],
      'options' => [
      ],
  ]);
  ```
  
  In this example, the controls do not use the default scroll icons, which are just the < and > arrows, but instead use the
  glyphicons that are used on the bootstrap example on their site.
  
  showIndicators is whether you want the small "radio" buttons that can click through onto each slide. This is true by default.
  
  The items then have one required field (that is the content for the slide) and the second field, which is an optional caption.
  
  As with most Yii widgets, there are options arrays which allow you to further customise the displayed widget.
