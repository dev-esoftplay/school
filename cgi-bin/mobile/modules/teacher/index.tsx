import React, { useState, useMemo, memo } from 'react';

import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { Text, View, Pressable } from 'react-native';

import Attenreport from './attenreport';
import Home from './home';
import Notif from './notif';
import Scan from './scan';

import { LibStyle } from 'esoftplay/cache/lib/style/import';
import { IoniconsTypes } from '@expo/vector-icons/build/esoftplay_icons';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import Profil from './profile';



export interface TeacherindexArgs { }
export interface TeacherindexProps {
  
 }

function m(props: TeacherindexProps): any {
  const [menu, setMenu] = useState('Beranda')??LibNavigation.getArgsAll(props);
 
  const [focused, setFocused] = useState(0);

  // Fungsi untuk merender konten berdasarkan nilai menu
  const renderContent = useMemo(() => {
    switch (menu) {
      case 'Beranda':
        return <Home />;
      case 'Absensi':
        return <Attenreport />;
      case 'Scan':
        return <Scan />;
      case 'Notifikasi':
        return <Notif />;
      case 'Akun':
        return <Profil/>;
      default:
        return <Home />;
    }
  }, [menu]);

  // Fungsi untuk merender satu item menu
  const renderMenuItem = (
    iconName: IoniconsTypes,
    label: string,
    index: number,
    iconNameOutline: IoniconsTypes,
    setpage: number) => (
    <Pressable
      key={index}
      onPress={() => {
        setMenu(label);
        setFocused(setpage);
      }}
      style={{ width: 55, backgroundColor: 'white', marginHorizontal: 10, alignItems: 'center' }} >
      <View style={{ alignItems: 'center' }}>
        {/* Menggunakan ikon dari LibIcon.Ionicons */}
        <LibIcon.Ionicons
          name={focused === index ? iconName : `${iconNameOutline}`}
          size={24}
          // Warna ikon berubah berdasarkan apakah menu difokuskan atau tidak
          color={index === focused ? "#00848d" : "#bfbfbf"}
        />
        {/* Label menu dengan styling tertentu */}
        <Text style={{ fontSize: 12, fontWeight: 'bold', marginBottom: 0, marginVertical: 5, color: index === focused ? "#00848d" : "#bfbfbf" }}>{label}</Text>
      </View>
    </Pressable>
  );

  // Render komponen utama
  return (
    <View style={{ flex: 1, backgroundColor: 'white' }}>
      {/* <Text style={{ fontSize: 20, fontWeight: 'bold', color: '#000000', textAlign: 'center', marginTop: 20 }}>Selamat Datang, {menu}</Text>
      <Text style={{ fontSize: 15, color: '#000000', textAlign: 'center', marginBottom: 20 }}>{focused}</Text> */}

      {renderContent}

      <View
        style={{
          height: 80,
          borderTopLeftRadius: 20,
          borderTopRightRadius: 20,
          paddingVertical: 10,
          backgroundColor: '#ffffff',
          width: LibStyle.width,
          flexDirection: 'row',
         justifyContent:'center'
        }} >

        {/* Render item-menu untuk setiap layar */}
        {renderMenuItem('home', 'Beranda', 0, 'home-outline', 0)}
        {renderMenuItem('newspaper', 'Absensi', 1, 'newspaper-outline', 1)}
        {/* {renderMenuItem('qr-code', 'Scan', 2, 'qr-code-outline', 2)} */}
        <Pressable
          key={2}
          onPress={() => {
            setMenu('Scan');
            setFocused(2);
          }}
          
          style={{ width: 50, backgroundColor: 'white', marginHorizontal: 10, alignItems: 'center',}} >
         <View style={{ backgroundColor: 'white', width: 80, height: 80, borderRadius: 40, justifyContent: 'center', alignItems: 'center', elevation: 5, marginTop: -60,marginBottom:5, borderColor: '#146C94', borderWidth: 5 }}>
            {/* Menggunakan ikon dari LibIcon.Ionicons */}
            <LibIcon.Ionicons
              name={focused === 2 ? 'qr-code' : 'qr-code-outline'}
              size={30}
              // Warna ikon berubah berdasarkan apakah menu difokuskan atau tidak
              color={2 === focused ? "#00848d" : "#bfbfbf"}
            />
            {/* Label menu dengan styling tertentu */}
          </View>
            <Text style={{ fontSize: 12, fontWeight: 'bold', marginBottom: 0, marginVertical: 5, color: 2 === focused ? "#00848d" : "#bfbfbf" }}>Scan</Text>
        </Pressable>
        {renderMenuItem('mail', 'Notifikasi', 3, 'mail-outline', 3)}
        {renderMenuItem('person', 'Akun', 4, 'person-outline', 4)}
      </View>
    </View>
  );
}

export default memo(m);