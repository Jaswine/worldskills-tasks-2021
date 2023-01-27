import React from 'react';
import styles from './Snowman.module.scss';
import snowman from '../../media/Game_assets/Snowman/snowman.svg'
import { useState } from 'react';
import Snow from '../snow/Snow';

function Snowman() {
  const [snow, setSnow] = useState('');

  document.addEventListener('keypress', e => {
    if (e.key == " ") {
      console.log('Go ')
    }
  })

  return (
    <div className={styles.pre_snowman}>
      <img src={snowman} alt="" className={styles.snowman} />
      <Snow/>
    </div>
  )
}

export default Snowman