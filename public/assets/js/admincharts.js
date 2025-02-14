document.addEventListener('DOMContentLoaded' ,  ()=>{
    fetchdata();
    addgraph()
})

async function fetchdata(){
    const cards = document.getElementById('cards');
    try{
        const res = await fetch('/statistics' , {
            method : 'GET'
        });
        const data = await res.json();
        console.log(data)

        cards.innerHTML =``;
        data?.cards?.map((item) => {
            cards.innerHTML += `
            <div class="bg-gray-800/30 backdrop-blur-sm rounded-lg p-6 border border-gray-700">
                <div class="flex items-center justify-between">
                    <h3 class="text-gray-400 text-sm font-medium">${item.title}</h3>
                    ${item.title == 'Total Events'  ? `
                    <div class="bg-purple-600/20 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>` : `` }
                    ${item.title == 'Active Users'  ? `
                    <div class="bg-pink-600/20 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>` : `` }
                    ${item.title == 'Total Revenue'  ? `
                    <div class="bg-green-600/20 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>` : `` }
                      ${item.title == 'AVG'  ? `
                        <span></span>
                    `: ``}
                </div>
                <p class="text-3xl font-bold mt-4">${item.value}</p>
                    ${item.etat == 'up' ?
                    `<p class="text-green-400 text-sm font-medium mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                    +${item.percentage}% from last month
                            </p>`:
                    `
                    <p class="text-red-400 text-sm font-medium mt-2 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"></path>
                            </svg>
                            -${item.percentage}% from last month
                        </p>
                    `
                    }
            </div>
            `;
        });

    }catch(error){
        cards.innerHTML = "Error loading page , please refrech page."
        return;
    }

}
async function addgraph() {
    
    const ctx = document.getElementById("revenueChart").getContext("2d");
    
    const data = {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
      datasets: [{
        label: "Booking",
        data: [65, 59, 80, 81, 56, 55, 40],
        fill: false,
        borderColor: "rgb(75, 192, 192)",
        tension: 0.1
      }]
    };

    new Chart(ctx, {
      type: "line",
      data: data,
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    });

}