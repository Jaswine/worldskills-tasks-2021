import React from 'react';
import styles from './Snowman.module.scss';
import snowman from '../../media/Game_assets/Snowman/snowman.svg'
import { useState } from 'react';
import Snow from '../snow/Snow';
import { useEffect } from 'react';
import Live from '../live/Live';
import EndForm from '../EndForm/EndForm';
import axios from 'axios';

function Snowman(props) {
  const [top, setTop] = useState(47);
  const [left, setLeft] = useState(7);
  const [transform, setTransform] = useState('rotate(-110deg)')
  const [scores, setScores] = useState(0)

  useEffect(() => {
    document.addEventListener('keypress', handleKeyPress);
    return () => {
      document.removeEventListener('keypress', handleKeyPress);
    }
  });


  const handleKeyPress = e => {
    console.log(e);
    if (e.key === ' ') {
      if (props.live == 3) {
        setTop(66)
        setLeft(70)
        setTransform('rotate(90deg)')
        setScores(scores+10)
        localStorage.setItem('scores', scores+8);
      }
      if (props.live == 2) {
        setTop(46)
        setLeft(76)
        setTransform('rotate(90deg)')
        setScores(scores+15)
        localStorage.setItem('scores', scores+10);
      }
      if (props.live == 1) {
        setTop(66)
        setLeft(80)
        setTransform('rotate(90deg)')
        setScores(scores+30)
        localStorage.setItem('scores', scores+14)
      }

      setTimeout(() => {
        restart()
      }, 3000);

      props.setLive(props.live-1)
    }
  }

  const restart = () => {
    setTop(47)
    setLeft(7)
    setTransform('rotate(180deg)')
  }

  return (
    <div className={styles.pre_snowman}>
      <img 
        src={snowman} 
        alt="" 
        className={styles.snowman}  
      />
      <Snow
        top={top}
        left={left}
        transform={transform}
      />
    </div>
  )
}

export default Snowman