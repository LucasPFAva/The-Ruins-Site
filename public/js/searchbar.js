// Placeholder code for concept purposes.

let searchable = [
    {name: "Jester", href: "character/jester"},
    {name: "Knight", href: "character/knight"},
    {name: "Summoner", href: "character/summoner"},
    {name: "Gunslinger", href: "character/gunslinger"},
    {name: "Bard", href: "character/bard"}
];

const searchWrapper = document.querySelector('#results');

document.getElementById('search').addEventListener('keyup', (e)=>{
    let results = [];
    let input = e.target.value;
    if (input.length) {
        results = searchable.filter((item)=>{
            return item.name.toLowerCase().includes(input.toLowerCase());
        });
    }

    if (results.length) {
        let content = results.map((item)=>{
            return `<li><a href="/public/${item.href}">${item.name}</a></li>`;
        }).join('');

        searchWrapper.classList.add('show');
        document.getElementById('results').innerHTML = content;
    } else {
        searchWrapper.classList.remove('show');
    }
});