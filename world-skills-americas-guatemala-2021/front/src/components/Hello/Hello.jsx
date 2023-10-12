import { useState } from 'react'
import styles from './Hello.module.css'
import Button from '../ui/Button/Button'

const Hello = (display='flex', opacity=1) => {
  // !______________________  FLEX  1 ____________________!
  // states
  const [helloWindow, setHelloWindow] = useState(display)
  const [opacityHelloWindow, setOpacityHelloWindow] = useState(opacity)

  // Closed window
  const closeWindow = () => {
    // Change opacity
    setOpacityHelloWindow('0')
    setTimeout(() => {
      // Add display none
      setHelloWindow('none')
    }, 400)
  }

  return (
    <div 
    className={styles.hello__place}
    style={{display: helloWindow, opacity: opacityHelloWindow}}
    >
      <div 
        className={styles.hello_window}  >
        <h2 >Worldskills Americas</h2>
        <p>Welcome to the Guatemala Memory Game</p>
        <Button onClick={closeWindow}>Start Game</Button>
      </div>
    </div>
  )
}

export default Hello