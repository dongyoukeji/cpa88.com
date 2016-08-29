/**
 * 空操作
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('noop', function(options) {
  return options.fn(this);
});
/**
 * 加粗
 * @param  {String}
 * @return {[type]}
 */
Handlebars.registerHelper('bold', function(options) {
  return new Handlebars.SafeString(
      '<b>'
      + options.fn(this)
      + '</b>');
});
/**
 * 输出
 * @param  {[type]}
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('with', function(context, options) {
  return options.fn(context);
});
/**
 * 安全字符
 * @param  {[type]}
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('link', function(text, url) {
  text = Handlebars.Utils.escapeExpression(text);
  url  = Handlebars.Utils.escapeExpression(url);
  var result = '<a href="' + url + '">' + text + '</a>';
  return new Handlebars.SafeString(result);
});
/**
 *  IF 判断
 * @param  {[type]}
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('if', function(conditional, options) {
  if(conditional) {
    return options.fn(this);
  } else {
    return options.inverse(this);
  }
});
/**
 * list 遍历
 {{#list array}}
  {{@index}}. {{title}}
{{/list}}
 * @param  {[type]}
 * @param  {String}
 * @return {[type]}
 */
Handlebars.registerHelper('list', function(context, options) {
  return "<ul>" + context.map(function(item) {
    return "<li>" + unescape(options.fn(item).replace(/\u/g, "%u")); + "</li>";
  }).join("\n") + "</ul>";
});
/**
 * 遍历
 <div class="comments">
  {{#each comments}}
    <div class="comment">
      <h2>{{subject}}</h2>
      {{{body}}}
    </div>
  {{/each}}
</div>
 * @param  {[type]}
 * @param  {String}
 * @return {[type]}
 */
Handlebars.registerHelper('each', function(context, options) {
  var ret = "";
  for(var i=0, j=context.length; i<j; i++) {
    $str = unescape(options.fn(context[i]).replace(/\u/g, "%u"));
    ret = ret + $str;
  }

  return ret;
});
/**
 * 带参数的list遍历
 {{#list nav id="nav-bar" class="top"}}
   <a href="{{url}}">{{title}}</a>
 {{/list}}
 * @param  {[type]}
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('list-arguments', function(context, options) {
  var attrs = Em.keys(options.hash).map(function(key) {
    return key + '="' + options.hash[key] + '"';
  }).join(" ");

  return "<ul " + attrs + ">" + context.map(function(item) {
    return "<li>" + options.fn(item) + "</li>";
  }).join("\n") + "</ul>";
});
/**
 * 多参数输出
 *{{#block-params 1 2 3 as |foo bar baz|}}
	  {{foo}} {{bar}} {{baz}}
  {{/block-params}}
 * @param  {Array}
 * @return {[type]}
 */
Handlebars.registerHelper('block-params', function() {
  var args = [],
      options = arguments[arguments.length - 1];
  for (var i = 0; i < arguments.length - 1; i++) {
    args.push(arguments[i]);
  }
  return options.fn(this, {data: options.data, blockParams: args});
});
/**
 * 原始输出
 * {{{{raw}}}} {{bar}} {{{{/raw}}}}
 * @param  {[type]}
 * @return {[type]}
 */
Handlebars.registerHelper('raw', function(options) {
  return options.fn();
});
