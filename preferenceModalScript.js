let currentGroupIndex = 0; // Start from the first hidden group
let allLoadedIngredients = []; // Array to track all loaded ingredients
let selectedDietaryPreference = []; // Variable to track selected dietary preference
let selectedIngredients = []; // Array to track selected ingredients
let selectedCuisine = []; // Variable to track selected cuisine preference    
let selectedExperience = ''; // Variable to track selected cooking experience
let selectedProfilePic = ''; // Variable to track selected profile picture
let selectedBio = ''; // Variable to track selected bio

function createIngredientButton(ingredient) {
    const button = document.createElement('button');
    button.className = 'preference-tag';
    button.textContent = ingredient;
    button.setAttribute('data-ingredient', ingredient); // Ensure this attribute is set
    return button;
}

function displayIngredients() {
    const container = document.getElementById('ingredients-container');
    const showLessButton = document.getElementById('showLessIngredients');

    container.innerHTML = ''; // Clear the container

    // First, display the selected ingredients at the top
    selectedIngredients.forEach(ingredient => {
        const button = createIngredientButton(ingredient);
        button.classList.add('selected'); // Ensure the button is marked as selected
        container.appendChild(button);
    });

    // Then, display the rest of the ingredients, avoiding duplicates
    allLoadedIngredients.slice(0, displayCount).forEach(ingredient => {
        if (!selectedIngredients.includes(ingredient)) {
            const button = createIngredientButton(ingredient);
            container.appendChild(button);
        }
    });

    // Control the visibility of "Show Less" button
    showLessButton.style.display = displayCount > 10 ? 'block' : 'none';
}

let currentOffset = 0;
let displayCount = 10;

function loadMoreIngredients() {
    let dataToSend = {
        offset: currentOffset,
        search: ''
    };

    fetch('getIngredients.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(dataToSend)
    })
    .then(response => response.json())
    .then(data => {
        const newIngredients = data.filter(ingredient => 
        !allLoadedIngredients.includes(ingredient));
        allLoadedIngredients = allLoadedIngredients.concat(newIngredients);

        currentOffset += data.length; // Increment total number of loaded ingredients
        displayCount = Math.min(allLoadedIngredients.length, displayCount + data.length); // Update display count, but don't exceed total loaded ingredients
        displayIngredients();
    })
    .catch(error => {
        console.error("Error fetching ingredients:", error);
    });
}

document.getElementById('showLessIngredients').addEventListener('click', function() {
    displayCount = Math.max(10, displayCount - 10); // Decrease display count but not below 10
    displayIngredients();
});

document.getElementById('ingredientSearch').addEventListener('input', function() {
    const searchValue = this.value.trim();
    if (searchValue) {
        let dataToSend = {
            offset: 0,
            search: searchValue
        };
        fetch('getIngredients.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(dataToSend)
        })
        .then(response => response.json())
        .then(data => {
            allLoadedIngredients = data;
            displayIngredients();
        });
    } else {
        currentOffset = 0; // Reset the offset
        loadMoreIngredients();
    }
});

// Event listener for the "Load More" button
document.getElementById('loadMoreIngredients').addEventListener('click', function() {
    loadMoreIngredients(currentOffset);
});

loadMoreIngredients(0);

document.getElementById('ingredientSearch').addEventListener('input', function() {
    const searchValue = this.value.trim();
    const container = document.getElementById('ingredients-container');
    
    if (searchValue) {
        container.innerHTML = ''; // Clear existing buttons only if there's a search term
        // Fetch and display ingredients that match the search term
        fetch('getIngredients.php?search=' + encodeURIComponent(searchValue))
            .then(response => response.json())
            .then(data => {
                displayIngredients(data);
            });
    } else {
        // If the search term is empty, reload the initially loaded ingredients
        container.innerHTML = ''; // Clear the container before reloading initial ingredients
        loadMoreIngredients(0);
    }
});

document.querySelector('.load-more-cuisines').addEventListener('click', function() {
    const groupToShow = document.querySelector('.cuisine-preferences .cuisine-group[data-index="' + currentGroupIndex + '"]');
    if (groupToShow) {
        groupToShow.style.display = 'block';
        currentGroupIndex++;
    } else {
        this.style.display = 'none';
    }
});

function updateSelectedIngredients(ingredient, isSelected) {
    const index = selectedIngredients.indexOf(ingredient);
    if (isSelected) {
        if (index === -1) {
            selectedIngredients.push(ingredient);
        }
    } else {
        if (index !== -1) {
            selectedIngredients.splice(index, 1);
        }
    }
    console.log(selectedIngredients);
    displayIngredients(); // Redisplay ingredients to reflect changes
}

// Function to update cuisine preferences array
function updateCuisinePreference(tag, isSelected) {
    const preference = tag.textContent;
    if (isSelected) {
        // Add preference if not present and if there is still room
        if (!selectedCuisine.includes(preference)) {
            selectedCuisine.push(preference);
        }
    } else {
        // Remove preference if deselected
        const index = selectedCuisine.indexOf(preference);
        if (index > -1) {
            selectedCuisine.splice(index, 1);
        }
    }
    console.log('Cuisine Preferences:', selectedCuisine);
}

// Function to update cooking experience
function updateCookingExperience(selectedTag) {
    selectedExperience = selectedTag.textContent;
    console.log(selectedExperience);
}

function handleSelection(clickedTag, maxSelections, container) {
    const selectedCount = container.querySelectorAll('.preference-tag.selected').length;

    if (clickedTag.classList.contains('selected')) {
        clickedTag.classList.remove('selected');
    } else if (selectedCount < maxSelections) {
        clickedTag.classList.add('selected');
    }
}

// Dietary preferences selection
document.querySelectorAll('.dietary-preferences .preference-tag').forEach(tag => {
    tag.addEventListener('click', function() {
        this.classList.toggle('selected'); // Toggle class to reflect selection
        updateDietaryPreference(this, this.classList.contains('selected'));
    });
});

function updateDietaryPreference(tag, isSelected) {
    const preference = tag.textContent;
    if (isSelected) {
        if (!selectedDietaryPreference.includes(preference)) {
            selectedDietaryPreference.push(preference);
        }
    } else {
        selectedDietaryPreference = selectedDietaryPreference.filter(item => item !== preference);
    }
    console.log('Dietary Preferences:', selectedDietaryPreference);
}

// Cuisine preferences selection
document.querySelectorAll('.cuisine-preferences .preference-tag').forEach(tag => {
    tag.addEventListener('click', function() {
        let selectedCuisines = document.querySelectorAll('.cuisine-preferences .preference-tag.selected');
        if (this.classList.contains('selected')) {
            this.classList.remove('selected');
            updateCuisinePreference(this, false);
        } else if (selectedCuisines.length < 3) {
            this.classList.add('selected');
            updateCuisinePreference(this, true);
        } else {
            console.log("You can't select more than 3 cuisines.");
        }
    });
});

function updateCuisinePreference(tag, isSelected) {
    const preference = tag.textContent;
    if (isSelected) {
        if (!selectedCuisine.includes(preference)) {
            selectedCuisine.push(preference);
        }
    } else {
        selectedCuisine = selectedCuisine.filter(item => item !== preference);
    }
    console.log('Cuisine Preferences:', selectedCuisine);
}

// Add event listeners to cooking experience tags
document.querySelectorAll('.cooking-experience .preference-tag').forEach(tag => {
    tag.addEventListener('click', function() {
        document.querySelectorAll('.cooking-experience .preference-tag.selected').forEach(selectedTag => {
            selectedTag.classList.remove('selected');
        });
        // Add 'selected' to the clicked tag
        this.classList.add('selected');
        // Update cooking experience
        updateCookingExperience(this);
    });
});

function handleExperienceSelection(clickedTag, container) {
    container.querySelectorAll('.preference-tag.selected').forEach(tag => {
        tag.classList.remove('selected');
    });

    clickedTag.classList.add('selected');
}

const experienceContainer = document.querySelector('.cooking-experience');
experienceContainer.addEventListener('click', function(event) {
    if (event.target && event.target.matches('.preference-tag')) {
        handleExperienceSelection(event.target, experienceContainer);
    }
});

// Define the ingredientContainer outside the event listener
let ingredientContainer = document.querySelector('#ingredients-container');

document.querySelector('#ingredients-container').addEventListener('click', function(event) {
    if (event.target && event.target.matches('.preference-tag')) {
        let selectedCount = this.querySelectorAll('.preference-tag.selected').length;
        let isAlreadySelected = event.target.classList.contains('selected');

        if (isAlreadySelected || selectedCount < 5) {
            event.target.classList.toggle('selected');
            updateSelectedIngredients(event.target.textContent, event.target.classList.contains('selected'));
        } else if (!isAlreadySelected && selectedCount >= 5) {
            console.log("You can't select more than 5 ingredients");
        }
    }
});

const cuisineContainer = document.querySelector('.cuisine-preferences');

function checkAllPreferencesSelected() {
    const dietaryContainer = document.querySelector('.dietary-preferences');
    const dietarySelected = dietaryContainer.querySelector('.preference-tag.selected') !== null;
    const allCuisinesSelected = cuisineContainer.querySelectorAll('.preference-tag.selected').length === 3;
    const experienceSelected = experienceContainer.querySelector('.preference-tag.selected') !== null; 
    const ingredientsSelected = selectedIngredients.length >= 5;

    // Update button style if all conditions are met
    const saveButton = document.getElementById('savePreferences');
    if (allCuisinesSelected && experienceSelected && ingredientsSelected && dietarySelected) {
        saveButton.classList.add('all-selected');
        saveButton.disabled = false;
    } else {
        saveButton.classList.remove('all-selected');
        saveButton.disabled = true;
    }
}

// Call this function whenever a selection is made or updated
document.querySelectorAll('.preference-category').forEach(category => {
    category.addEventListener('click', function() {
        checkAllPreferencesSelected();
    });
});

checkAllPreferencesSelected();

document.getElementById('profilePicUpload').addEventListener('change', function(event) {
    if (event.target.files && event.target.files[0]) {
        // FileReader to read the selected file
        const reader = new FileReader();

        reader.onload = function(e) {
            // Set the src of the img element to the file's data URL
            document.getElementById('profilePicDisplay').src = e.target.result;
        };

        // Read the file
        reader.readAsDataURL(event.target.files[0]);
    }
});

document.getElementById('savePreferences').addEventListener('click', function() {
    const modalHeader = document.querySelector('.preference-modal-header');
    const modalContent = document.querySelector('.preference-modal-content');
    // Hide preference sections
    document.querySelectorAll('.preference-category').forEach(function(category) {
      category.style.display = 'none';
    });
    document.querySelector('.load-more-cuisines').style.display = 'none'; // Hide this if it's part of the preferences
    modalHeader.textContent = 'Complete Your Profile';
    modalHeader.style.setProperty('font-size', '38px', 'important');
    modalContent.style.setProperty('width', '550px');
    // Hide the "Save Preferences" button
    this.style.display = 'none';
  
    // Show the profile picture and bio inputs
    document.getElementById('profilePicInput').style.display = 'block';
    document.getElementById('bioInput').style.display = 'block';
  
    // Show the "Complete Profile" button
    document.getElementById('completeProfile').style.display = 'block';
  });  