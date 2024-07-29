function showSection(section) {
    var feedSection = document.querySelector('.discover-feed');
    var communitySection = document.querySelector('.discover-community');
    if (section === 'feed') {
        feedSection.style.display = 'block';
        communitySection.style.display = 'none';
    } else {
        feedSection.style.display = 'none';
        communitySection.style.display = 'block';
    }
}


document.getElementById('postForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const postContent = document.getElementById('postContent').value;
    if (postContent.trim()) {
        const postItem = document.createElement('li');
        postItem.textContent = postContent;
        document.getElementById('postsList').appendChild(postItem);
        document.getElementById('postContent').value = '';
    }
});