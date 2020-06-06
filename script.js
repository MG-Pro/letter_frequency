document.addEventListener('DOMContentLoaded', () => {
    const submitBtn = document.querySelector('#submit-btn')
    const textArea = document.querySelector('#text')
    const resultBlock = document.querySelector('#result')
    const resultContent = resultBlock.querySelector('#result-content')

    textArea.addEventListener('input', () => {
        submitBtn.disabled = textArea.value.length <= 3
    })

    submitBtn.addEventListener('click', (e) => {
        e.preventDefault()
        resultContent.innerHTML = null
        resultBlock.classList.add('hide');
        
        const body = JSON.stringify({
            text: textArea.value
        })
        fetch('api.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body
        })
            .then((res) => res.json())
            .then((data) => setResult(data));
    })
    
    function setResult(resultData) {
        document.getElementById('vowels').textContent = resultData['vowels_freq']
        document.getElementById('consonants').textContent = resultData['consonants_freq']
        resultBlock.classList.remove('hide');
        Object.entries(resultData['letter_freq']).forEach((item) => {
            resultContent.appendChild(createLine(item[0], item[1]))
        })
    }
    
    function createLine(letter, frequency) {
        const line = document.createElement('div')
        line.classList.add('line')
        const spanName = document.createElement('span')
        const spanFrequency = document.createElement('span')
        const spanMid = document.createElement('span')
        spanName.textContent = letter
        spanMid.textContent = ' : '
        spanFrequency.textContent = frequency
        line.appendChild(spanName)
        line.appendChild(spanMid)
        line.appendChild(spanFrequency)
        return line
    }
})
