document.getElementById('searchBtn').addEventListener('click', function() {
    var searchInput = document.getElementById('searchInput');
    var searchContainer = document.querySelector('.search-container');
    searchContainer.style.flexBasis = '600px'; // Expand to the designated space
    searchInput.style.borderColor = "#000000";
    searchInput.style.opacity = '1';
    searchInput.style.visibility = 'visible';
    searchInput.focus();
  });
  
  document.getElementById('searchInput').addEventListener('blur', function(event) {
    var searchContainer = document.querySelector('.search-container');
    if (!event.target.value) {
        searchContainer.style.flexBasis = '250px'; // Shrink back to the default size
        event.target.style.opacity = '0';
        event.target.style.visibility = 'hidden';
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    var ingredientsList = document.querySelectorAll('.ingredientslist li');

    ingredientsList.forEach(function(li, index) {
        // Create a checkbox for each list item
        var checkbox = document.createElement('input');
        checkbox.setAttribute('type', 'checkbox');
        checkbox.className = 'ingredient-checkbox';
        checkbox.id = 'ingredient-checkbox-' + index; // Unique ID for each checkbox

        var label = document.createElement('label');
        label.setAttribute('for', 'ingredient-checkbox-' + index); // Link label to the corresponding checkbox
        label.className = 'custom-checkbox-label';

        // Prepend the checkbox and label to the list item
        li.prepend(label);
        li.prepend(checkbox);

        // Add an event listener to handle the strikethrough
        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                li.style.textDecoration = 'line-through';
            } else {
                li.style.textDecoration = 'none';
            }
        });
    });
});