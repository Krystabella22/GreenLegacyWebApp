function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');
    if (sidebar.style.width === '250px') {
        sidebar.style.width = '0';
        main.style.marginLeft = '0';
    } else {
        sidebar.style.width = '250px';
        main.style.marginLeft = '250px';
    }
}

document.getElementById('logForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('log_activity.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert('Activity logged successfully!');
        // Update total trees count
        updateTotalTrees();
        // Optionally, update leaderboard here
    })
    .catch(error => console.error('Error:', error));
});

function updateTotalTrees() {
    fetch('total_trees.php')
        .then(response => response.json())
        .then(data => {
            document.getElementById('totalTrees').innerText = data.totalTrees;
        })
        .catch(error => console.error('Error:', error));
}

function fetchLeaderboard() {
    fetch('leaderboard.php')
        .then(response => response.json())
        .then(data => {
            const leaderboardContent = document.getElementById('leaderboardContent');
            leaderboardContent.innerHTML = '<ul>' + data.map(item => 
                `<li>${item.name}: ${item.treeCount} trees</li>`
            ).join('') + '</ul>';
        })
        .catch(error => console.error('Error:', error));
}

// Fetch leaderboard and total trees on page load
document.addEventListener('DOMContentLoaded', function() {
    fetchLeaderboard();
    updateTotalTrees();
        // Create a new Chart instance
        const activityChart = new Chart(ctx, {
            type: 'bar', // Define the type of chart: bar chart
            data: {
                labels: ['Quiz Creation', 'Quiz Review', 'Quiz Edit', 'Quiz Deletion'], // Labels for the x-axis
                datasets: [{
                    label: 'Number of Activities', // Label for the dataset
                    data: [12, 19, 3, 5], // Data for the chart
                    backgroundColor: [ // Background color of the bars
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [ // Border color of the bars
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1 // Border width of the bars
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Start the y-axis at zero
                    }
                }
            }
        });
    
});
