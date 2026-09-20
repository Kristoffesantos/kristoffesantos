'use strict';

const projects = [
  {
    title: 'CODEXIA PHCI',
    description: 'An RPG-inspired educational website designed to help beginners learn programming logic through gamified quests and interactive puzzles.',
    tags: ['HTML', 'CSS', 'JavaScript'],
    year: 2026
  },
  {
    title: 'CheapByte',
    description: 'A responsive e-commerce PC hardware catalog concept featuring product specs, category sorting, and client-side budget estimation.',
    tags: ['JavaScript', 'CSS Grid', 'HTML5'],
    year: 2025
  },
  {
    title: 'Personal Portfolio',
    description: 'A fast, accessible single-page portfolio highlighting coursework, developer skills, and dynamic project filtering using vanilla web APIs.',
    tags: ['HTML', 'CSS', 'JavaScript'],
    year: 2026
  },
  {
    title: 'Linux Practice Lab',
    description: 'A mock web terminal reference tool providing syntax cheat-sheets and simulated command execution for Ubuntu and Debian server administration.',
    tags: ['Linux', 'Bash', 'JavaScript'],
    year: 2025
  }
];

const projectList = document.getElementById('project-list');
const projectSearch = document.getElementById('project-search');
const projectCount = document.getElementById('project-count');

/**
 * Filters a project list according to a search term.
 * Pure function: Does NOT directly modify the webpage.
 *
 * @param {Array<Object>} list - The project array to filter.
 * @param {string} searchTerm - The string entered by the user.
 * @returns {Array<Object>} The filtered list matching title, description, or tags.
 */
function filterProjects(list, searchTerm) {
  if (!Array.isArray(list)) {
    return [];
  }

  const cleanedTerm = (searchTerm || '').trim().toLowerCase();

  // If the search input is empty, return the complete list
  if (cleanedTerm === '') {
    return list;
  }

  return list.filter(function (project) {
    const titleMatch = (project.title || '').toLowerCase().includes(cleanedTerm);
    const descMatch = (project.description || '').toLowerCase().includes(cleanedTerm);
    
    // Check if any tag matches the search term
    const tagMatch = Array.isArray(project.tags) && project.tags.some(function (tag) {
      return (tag || '').toLowerCase().includes(cleanedTerm);
    });

    return titleMatch || descMatch || tagMatch;
  });
}

/**
 * Renders the project cards and updates the project count.
 * This is the ONLY function that writes the project results/count to the page.
 * Uses document.createElement() and textContent to prevent unsafe injection.
 *
 * @param {Array<Object>} list - The list of projects to display.
 */
function renderProjects(list) {
  if (!projectList || !projectCount) {
    return;
  }

  // Clear existing items in container
  projectList.textContent = '';

  const totalCount = projects.length;
  const currentCount = Array.isArray(list) ? list.length : 0;

  // Update project count indicator
  projectCount.textContent = 'Showing ' + currentCount + ' of ' + totalCount + ' projects';

  // Handle empty state
  if (currentCount === 0) {
    const emptyItem = document.createElement('li');
    emptyItem.className = 'no-results';
    emptyItem.textContent = 'No projects found. Try another search.';
    projectList.appendChild(emptyItem);
    return;
  }

  // Loop through list and build DOM cards
  list.forEach(function (project) {
    const cardItem = document.createElement('li');
    cardItem.className = 'project-card';

    // Header container (title + year)
    const cardHeader = document.createElement('div');
    cardHeader.className = 'project-card-header';

    const cardTitle = document.createElement('h3');
    cardTitle.className = 'project-title';
    cardTitle.textContent = project.title || 'Untitled Project';

    const cardYear = document.createElement('span');
    cardYear.className = 'project-year';
    cardYear.textContent = project.year ? String(project.year) : 'N/A';

    cardHeader.appendChild(cardTitle);
    cardHeader.appendChild(cardYear);

    // Description
    const cardDesc = document.createElement('p');
    cardDesc.className = 'project-desc';
    cardDesc.textContent = project.description || 'No description available.';

    // Tags container
    const tagsContainer = document.createElement('div');
    tagsContainer.className = 'project-tags';

    if (Array.isArray(project.tags)) {
      project.tags.forEach(function (tag) {
        const tagSpan = document.createElement('span');
        tagSpan.className = 'project-tag';
        tagSpan.textContent = tag;
        tagsContainer.appendChild(tagSpan);
      });
    }

    // Assemble card
    cardItem.appendChild(cardHeader);
    cardItem.appendChild(cardDesc);
    cardItem.appendChild(tagsContainer);

    projectList.appendChild(cardItem);
  });
}

// Initial render on page load
renderProjects(projects);

// Real-time search event listener
if (projectSearch) {
  projectSearch.addEventListener('input', function (event) {
    const currentInput = event.target.value;
    const filteredResults = filterProjects(projects, currentInput);
    renderProjects(filteredResults);
  });
}