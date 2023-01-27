import React from 'react';
import styles from './Live.module.scss';
import {AiOutlineHeart} from 'react-icons/ai';

function Live({live}) {
  return (
    <div className = {styles.live}>{live}<AiOutlineHeart/></div>
  )
}

export default Live