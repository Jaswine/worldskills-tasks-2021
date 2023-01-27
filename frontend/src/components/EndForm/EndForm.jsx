import React from 'react';
import style from './EndForm.module.scss'
import { useState } from 'react';
import axios from 'axios';
import { useEffect } from 'react';
import Button from '../UI/button/Button';


function EndForm() {
  const [winners, setWinners] = useState();

  const [winnerName, setWinnerName] = useState('');
  const [winnerCountry, setWinnerCountry] = useState('');
  const [winnerScores, setWinnerScores] = useState('');


  useEffect(() => {
    getWinners();
    getWinnerData();
  }, []);

  const getWinners = async () => {
    axios.get('http://127.0.0.1:8000/api/game-finish')
      .then(res => {
        console.log(res.data.users)
        setWinners(res.data.users)
      });
  }

  const getWinnerData = () => {
    setWinnerName(localStorage.getItem('name'));
    console.log(localStorage.getItem('name'))
    setWinnerCountry(localStorage.getItem('country'));
    setWinnerScores(localStorage.getItem('scores'))
  }

  const reload = () => {
    window.location.reload();
    
  }

  return (
    <div className={style.endForm}>
      <div className={style.endForm__gamer}>
        <h1>{winnerName} - {winnerCountry} - {winnerScores}</h1>
      </div>
      <div className={style.endForm__gamers}>
        <div className={style.results}>
          {winners? (
            <div className={style.winners}>
              {winners.map((winner, key)=> 
                <div className={style.winner} key={key}>
                  <h2>{winner.user.name} - {winner.user.country}</h2>
                  <span>{winner.result}</span>
                </div>
              )}
              <div className={`${style.winner} ${style.super__winner}`}>
                <h2>{winnerName} - {winnerCountry}</h2>
                <span>{winnerScores}</span>
              </div>
            </div>
          ): (
            <h2>Loading...</h2>
          )}
        </div>
        <canvas className={style.share} width='300px' height='200px'>
          
        </canvas>
      </div>
      <Button handleFunction={reload} text='reload' />
    </div>
  )
}

export default EndForm