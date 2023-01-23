import React from 'react';
import styles from './StartForm.module.scss'
import Input from '../UI/input/Input';
import {CgSoftwareUpload} from 'react-icons/cg';

import Crystal from '../../media/Game_assets/Object/Crystal.png';
import Tree_2 from '../../media/Game_assets/Object/Tree_2.png';
import IceBox from '../../media/Game_assets/Object/IceBox.png';

import Button from '../UI/button/Button';
import { useState } from 'react';

import axios from 'axios';
import { useEffect } from 'react';

function StartForm() {
  const [name, setName] = useState('');
  const [country, setCountry] = useState('');
  const [file, setFile] = useState('');
  const [showForm, setShowForm] = useState(true);

  const send = async (e) => {
    e.preventDefault();

    // localStorage.setItem('name', name);
    // localStorage.setItem('country', country);

    // axios.post('http://127.0.0.1:8000/api/start-game', {
    //   name: name, 
    //   country: country,
    //   image: file
    // })
    //   .then(res => console.log(res.data.data))
      setShowForm(false)
  }

  return (
    <div className={showForm? styles.pre_form: styles.none}>
      <form className={styles.form}>
      <img src={Crystal} alt="" className={styles.crystal} />
      <img src={Tree_2} alt="" className={styles.tree} />
      <img src={Crystal} alt="" className={styles.icebox} />
        <Input 
          placeholder='Enter ur Name...' 
          value={name} 
          onChange={e => setName(e.target.value)}
        />
        <select 
          onChange={e => setCountry(e.target.value)}
        >
          <option value={country} selected disabled>Select Ur Country</option>
          <option value="UK">the United Kingdom</option>
          <option value="US">the United States</option>
          <option value="CN">China</option>
          <option value="MX">Mexico</option>
        </select>
        <span className={styles.get_files}>
          <CgSoftwareUpload className='icon'/>
          <input type="file" />
        </span>
        <Button handleFunction={send} text='continue' />  
      </form>
    </div>
  )
}

export default StartForm