import { useEffect, useState } from 'react'
import styles from '../Hello/Hello.module.css'
import Button from '../ui/Button/Button'

const Finish = ({display='none', opacity='0', scores=0}) => {
  // states
  const [helloWindow, setHelloWindow] = useState(display)
  const [opacityHelloWindow, setOpacityHelloWindow] = useState(opacity)
   // name and results and show results
  const [name, setName] = useState('')
  const [lastResults, setLastResults] = useState([])
  const [showResults, setShowResults] = useState(false)

  // loading after load component
  useEffect(() => {
   setLastResults(localStorage.getItem('lastResults') ? JSON.parse(localStorage.getItem('lastResults')) : [])
  }, [])

  // if click on ok
  const OK = () => {
   setShowResults(true)
   setLastResults([...lastResults, 
      {id: lastResults.length, name: name, scores: scores}])
  }

  // restart game
  const restart = () => {
   // set in localStorage
   localStorage.setItem('lastResults', JSON.stringify(lastResults))
   
   setTimeout(() => {
      // window reload
      window.location.reload()
   }, 200)
  }

  return (
    <div 
    className={styles.hello__place}
    style={{display: helloWindow, opacity: opacityHelloWindow}}
    >
      <div 
        className={styles.hello_window}  >
         {showResults? (
            <>
              <h2>Results</h2>
               {lastResults? (
              <div className={styles.result__list}>
                  {lastResults.map(result => 
                     <div className={styles.result} key={result.id}>
                        <b>{result.name}</b>
                        <span> {result.scores}</span>
                     </div>   
                  ) }
              </div>
               ): (
                  <h2>Results not found, bro</h2>
               )}
              <Button 
                  onClick={restart}
                  >Restart</Button>
            </>
         ): (
            <>
               <p>Enter Your Name For Get Your Results:</p>
             <input 
                  type="text"
                  placeholder='Enter your name...' 
                  onChange={(e) => setName(e.target.value)}
                  value={name}
               />
               <Button 
                  onClick={OK}
                  disabled={name.length == 0? true : false}
                  >OK</Button>
            </>
         )}
      </div>
    </div>
  )
}

export default Finish