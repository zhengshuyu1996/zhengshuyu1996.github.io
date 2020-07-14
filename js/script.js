// Copyright 2019 Google LLC
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     https://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.


/**
 * Comment Style Code 
 */
var comment_item_code = '\
<div class="comment-item">\
    <div class="row">\
        <div class="pull-left">\
            <span class="fa-stack fa-2x">\
                <i class="fa fa-circle fa-stack-2x color-grey"></i>\
                <i class="fa fa-user fa-stack-1x fa-inverse"></i>\
            </span> \
        </div>\
        <div class="pull-left">\
            <p class="comment-name">'
var comment_name_code = '</p>\
            <p class="comment-time">'
var comment_time_code = '</p>\
        </div>\
    </div>\
    <p class="comment-text">'
var comment_text_code = '</p></div>'


/**
 * Adds comment message to the page.
 */
function getComments() {
    console.log("getComments");
    fetch('/data')
    .then(response => response.json())
    .then((comments) => {
        var comment_content = '';
        for (var i = 0; i < comments.length; i++) {
            comment_content = comment_content + comment_item_code;
            comment_content = comment_content + comments[i].userName;
            comment_content = comment_content + comment_name_code;
            comment_content = comment_content + comments[i].currentTime;
            comment_content = comment_content + comment_time_code;
            comment_content = comment_content + comments[i].commentText;
            comment_content = comment_content + comment_text_code;
        }
        console.log(comment_content);
        document.getElementById('comment-list').innerHTML = comment_content;
  });
}

/**
 * Load comment message once the document is ready
 */
$(document).ready(function(){ 
    getComments();

    // Add smooth scroll listeners
    document.querySelector('#nav-home').addEventListener('click', function(e) {
        e.preventDefault();
        window.scroll({ top: 0, left: 0, behavior: 'smooth' });
    });
    document.querySelector('#nav-about').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#about').scrollIntoView({ behavior: 'smooth' });
    });
    document.querySelector('#nav-publication').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#publication').scrollIntoView({ behavior: 'smooth' });
    });
    document.querySelector('#nav-project').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#project').scrollIntoView({ behavior: 'smooth' });
    });
    document.querySelector('#nav-hobby').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#hobby').scrollIntoView({ behavior: 'smooth' });
    });
    document.querySelector('#nav-comment').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#comment').scrollIntoView({ behavior: 'smooth' });
    });
    document.querySelector('#nav-back').addEventListener('click', function(e) {
        e.preventDefault();
        window.scroll({ top: 0, left: 0, behavior: 'smooth' });
    });
});

