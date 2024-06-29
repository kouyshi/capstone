function toggleContent(contentId, arrowId) {
    var content = document.getElementById(contentId);
    var arrow = document.getElementById(arrowId);
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        arrow.textContent = '▲';
    } else {
        content.style.display = 'none';
        arrow.textContent = '▼';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const headers = document.querySelectorAll('.accordion-header');
        
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const activeHeader = document.querySelector('.accordion-header.active');
                if (activeHeader && activeHeader !== this) {
                    activeHeader.classList.remove('active');
                    activeHeader.nextElementSibling.style.display = 'none';
                }
    
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (this.classList.contains('active')) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });
}

// toggleContent


document.addEventListener("DOMContentLoaded", function() {
    var contents = document.querySelectorAll('.sowing-content');
    contents.forEach(function(content) {
        content.style.display = 'block';
    });
});

function toggleContent(contentId, arrowId) {
    var content = document.getElementById(contentId);
    var arrow = document.getElementById(arrowId);
    if (content.style.display === "none" || content.style.display === "") {
        content.style.display = "block";
        arrow.textContent = "▼";
    } else {
        content.style.display = "none";
        arrow.textContent = "►";
    }
}


    document.addEventListener('DOMContentLoaded', function() {
        const headers = document.querySelectorAll('.accordion-header');
        
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const activeHeader = document.querySelector('.accordion-header.active');
                if (activeHeader && activeHeader !== this) {
                    activeHeader.classList.remove('active');
                    activeHeader.nextElementSibling.style.display = 'none';
                }
    
                this.classList.toggle('active');
                const content = this.nextElementSibling;
                if (this.classList.contains('active')) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
        });
    });