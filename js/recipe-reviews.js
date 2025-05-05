document.addEventListener('DOMContentLoaded', function() {
    // Handle review form submission
    const reviewForm = document.getElementById('recipe-review-form');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('action', 'submit_recipe_review');
            
            fetch(ajaxurl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    }

    // Handle helpful votes
    const helpfulButtons = document.querySelectorAll('.helpful-vote-btn');
    helpfulButtons.forEach(button => {
        button.addEventListener('click', function() {
            const reviewId = this.dataset.reviewId;
            const formData = new FormData();
            formData.append('action', 'vote_recipe_review');
            formData.append('review_id', reviewId);
            formData.append('nonce', recipeReviews.nonce);

            fetch(ajaxurl, {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const countElement = this.querySelector('.helpful-count');
                    countElement.textContent = `(${data.data.votes})`;
                    this.classList.add('voted');
                    this.disabled = true;
                } else {
                    alert(data.data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            });
        });
    });
}); 