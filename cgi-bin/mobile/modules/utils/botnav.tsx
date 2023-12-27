// withHooks
import React, { memo, useEffect, useState } from 'react';
import { Pressable, Text, View } from 'react-native';
import { LibStyle } from 'esoftplay/cache/lib/style/import';
import Scan from '../teacher/scan';
import Home from '../teacher/home';
import Attenreport from '../teacher/attenreport';
import Notif from '../teacher/notif';
import Account from '../teacher/account';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { IoniconsTypes } from '@expo/vector-icons/build/esoftplay_icons';

// Deklarasi interface dan props untuk komponen
export interface UtilsBotnavArgs {}
export interface UtilsBotnavProps {}

// Deklarasi komponen utama
function UtilsBotnav(props: UtilsBotnavProps): any {
  // State untuk menyimpan nilai menu yang sedang aktif, status, indeks yang sedang difokuskan, dan komponen yang sedang dirender
  const [menu, setMenu] = useState('Beranda');
  const [focused, setFocused] = useState(0);
  const [renderedComponent, setRenderedComponent] = useState(<Home />);

  useEffect(() => {
    navigateToScreen(menu);
  }, [menu]);
  function navigateToScreen(data: string) {
    let newFocused = 0;
    let newRenderedComponent = null;
    switch (data) {
      case 'Beranda':
        newFocused = 0;
        newRenderedComponent = <Home />;
        break;
      case 'Absensi':
        newFocused = 1;
        newRenderedComponent = <Scan />;
        break;
      case 'Scan':
        newFocused = 2;
        newRenderedComponent = <Attenreport />;
        break;
      case 'Notifikasi':
        newFocused = 3;
        newRenderedComponent = <Notif />;
        break;
      case 'Akun':
        newFocused = 4;
        newRenderedComponent = <Account />;
        break;
      default:
        newFocused = 0;
        newRenderedComponent = <Home />;
    }

    setFocused(newFocused);
    setRenderedComponent(newRenderedComponent);
  }
  // Fungsi untuk merender satu item menu
  const renderMenuItem = (iconName: IoniconsTypes, label: string, index: number, iconNameOutline: IoniconsTypes) => (
    <Pressable key={index} onPress={() => setMenu(label)} style={{  width: "auto", backgroundColor: 'white', marginHorizontal: 10, alignItems: 'center' }}>
      <View style={{ alignItems: 'center' }}>
        {/* Menggunakan ikon dari LibIcon.Ionicons */}
        <LibIcon.Ionicons
          name={focused === index ? iconName : `${iconNameOutline}`}
          size={30}
          // Warna ikon berubah berdasarkan apakah menu difokuskan atau tidak
          color={index === focused ? "#00848d" : "#bfbfbf"}
        />
        {/* Label menu dengan styling tertentu */}
        <Text style={{ fontSize: 13, fontWeight: 'bold', marginBottom: 0, marginVertical: 5, color: index === focused ? "#00848d" : "#bfbfbf" }}>{label}</Text>
      </View>
    </Pressable>
  );

  // Render komponen utama
  return (
    <View style={{ flex: 1,  backgroundColor: 'pink'}}>

      
     {/* Render komponen yang sedang dirender */}
      {renderedComponent}
      {/* Render bar menu bawah */}
  
      <View
        style={{
          height: 60,
          backgroundColor: 'skyblue',
          width: LibStyle.width,
          flexDirection: 'row',
          alignSelf:'baseline',
         
          paddingHorizontal: 20,
          
        }}>
     
        {/* Render item-menu untuk setiap layar */}
        {renderMenuItem('ios-home', 'Beranda', 0, 'ios-home-outline')}
        {renderMenuItem('ios-newspaper', 'Absensi', 1, 'ios-newspaper-outline')}
        {renderMenuItem('ios-qr-code', 'Scan', 2, 'ios-qr-code-outline')}
        {renderMenuItem('ios-mail', 'Notifikasi', 3, 'ios-mail-outline')}
        {renderMenuItem('ios-person', 'Akun', 4, 'ios-person-outline')}
      </View>
    </View>
  );
}

// Memoize komponen untuk performa
export default memo(UtilsBotnav);