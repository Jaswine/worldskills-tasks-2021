import { useEffect, useState } from 'react';
import Hello from '../components/Hello/Hello';
import styles from './App.module.css';
import Button from '../components/ui/Button/Button';
import AppScripts from './AppScripts';
import Finish from '../components/Finish/Finish';

const App = () => {
  // get Scripts
  const {sortImages} = AppScripts()

  // Data
  const images = ['memo-01.jpg', 'memo-02.jpg', 'memo-03.jpg', 'memo-04.jpg', 'memo-05.jpg', 'memo-06.jpg', 'memo-07.jpg', 'memo-08.jpg', 'memo-09.jpg', 'memo-10.jpg', 'memo-01.jpg', 'memo-02.jpg', 'memo-03.jpg', 'memo-04.jpg', 'memo-05.jpg', 'memo-06.jpg', 'memo-07.jpg', 'memo-08.jpg', 'memo-09.jpg', 'memo-10.jpg']
  const [cards, setCards] = useState([])
  const [roundsCount, setRoundsCount] = useState(0)
  const [selectedElements, setSelectedElements] = useState([])
  const [showHello, setShowHello] = useState(true)

  // after page load
  useEffect(() => {
    writeToCardsAllImages(images)
    document.title  = 'Worldskills Americas'
  }, [])

  // Cards Sorting
  function writeToCardsAllImages (massive) {
    setRoundsCount(0)

    setCards(prevState=> prevState.map(obj =>
      obj ? {...obj, rotate: true} : {...obj, rotate: true}
    ))
    
    setTimeout(() => {
      const newData = sortImages(massive).map((item, key) => ({
        id: key,
        image: item,
        show: false, // ! IMPORTANT
        block: false,
        rotate: false
      }))

      setCards(newData)
      setShowHello(true)
    }, 300)
  }

  // show card when u select 
  function showCard (e, card) {
    setShowHello(false)
    setCards(prevState=> prevState.map(obj =>
      obj.id == card.id ? {...obj, rotate: true} : obj
    ))
    
    setTimeout(() => {
      setCards(prevState=> prevState.map(obj =>
        obj.id == card.id ? {...obj, show: card.show? false: true, rotate: false} : obj
      ))
    
    }, 300)
    
     // Selected Elements
    setSelectedElements((prevSelectedElements) => {
      const newSelectedElements = [...prevSelectedElements, card]

        // if 2 elements are selected 
      if (newSelectedElements.length === 2) {
        if (newSelectedElements[0].image === newSelectedElements[1].image) {
          // count rounds
          if (newSelectedElements[0].block != true && newSelectedElements[1].block != true) {
            setRoundsCount(roundsCount+1)
            setCards(prevState=> prevState.map(obj =>
              obj.image == card.image ? {...obj, show: true, block: true} : obj
            ))

            return []
          }
        } else {
         setTimeout(() => {
          // show is false 
          setCards(prevState=> prevState.map(obj =>
            obj.id == card.id ? 
            {...obj, show: false} : 
            {...obj, show: false}
          ))
         }, 1300)
        }
        return []
      }
      return newSelectedElements
    })
  }

  return (
    <div 
    className={styles.app}
    >
      {roundsCount > 9? <Finish display='flex' opacity='1' scores={roundsCount} />: <></>}
      {showHello? <Hello opacity='1' display='flex' />: <></>}
      <div className={styles.app__window}>
         <div className={styles.game__area}>
          <div className={styles.game__area__cards}>
            {cards.map((card, item) => 
              <div 
              className={`${styles.card} ${card.block? '': card.rotate? styles.cardRotate: ''}`}
              key={item}
              onClick={(e) => card.block? '': showCard(e, card)}
             >
                {card.block? (<img src={`/${card.image}`} alt="{card.image}" />): (
                  card.show? 
                  (<img src={`/${card.image}`} alt="{card.image}" />): 
                  (<span>:]</span>)
                ) }
              </div>
            )}
          </div>
         </div>
         <div className={styles.stats}>
            <div className={styles.stats__header}>
              <span className={styles.stats__header__count}>Rounds: 
                {roundsCount}</span>
            </div>
            <div className={styles.stats__header}>
              <Button 
                onClick={() => writeToCardsAllImages(images)}>Restart</Button>
            </div>
         </div>
      </div>
    </div>
  )
}

export default App