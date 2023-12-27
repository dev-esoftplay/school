// withHooks
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { hide } from 'esoftplay/modules/lib/toast';
import Checkbox from 'expo-checkbox';
import { memo, useState } from 'react';

import React from 'react';
import { FlatList, Modal, Pressable, StyleSheet, Text, TouchableOpacity, View } from 'react-native';
import CustomPopup from '../utils/custompopup';


export interface TeacherAttendenceArgs {

}
export interface TeacherAttendenceProps {


}



function m(props: TeacherAttendenceProps): any {

  const data: string = LibNavigation.getArgsAll(props).data;
  const [isChecked, setChecked] = useState(false);
  const [visible, setVisible] = useState(false);
  const datakelas:any = [
    {
      "No.absen": "01",
      "Nama": "Anies Rasyid Baswedan",
      "keterangan": "Hadir",
      "color": "#0DBD5E",
      LibIcon:"check"
    },
    {
      "No.absen": "02",
      "Nama": "Gibran Rakabuming Raka",
      "keterangan": "Alfa",
      "color": "#FF4343",
      LibIcon:"close"
    },
    {
      "No.absen": "03",
      "Nama": "Basuki Tjahaja Purnama",
      "keterangan": "Alfa",
      "color": "#FF4343",
      LibIcon:"close"
    },
    {
      "No.absen": "04",
      "Nama": "Ganjar Pranowo",
      "keterangan": "Sakit",
      "color": "#F6C956",
      //<MaterialCommunityIcons name="emoticon-sick-outline" size={24} color="black" />
      LibIcon:"emoticon-sick-outline"
    },
    {
      "No.absen": "05",
      "Nama": "Ridwan Kamil",
      "keterangan": "Izin",
      "color": "#0083FD",
      //<EvilIcons name="envelope" size={24} color="black" />
      LibIcon:"exclamation"
    },
    {
      "No.absen": "06",
      "Nama": "Ridwan Kamil",
      "keterangan": "Izin",
      "color": "#0083FD",
      //<EvilIcons name="exclamation" size={24} color="black" />
      //<AntDesign name="exclamationcircleo" size={24} color="black" />
      LibIcon:"exclamation"
    },
    {
      "No.absen": "07",
      "Nama": "Joko Widodo",
      "keterangan": "Hadir",
      "color": "#0DBD5E",
      LibIcon:"check"
    },
    {
      "No.absen": "08",
      "Nama": "Anies Rasyid Baswedan",
      "keterangan": "Hadir",
      "color": "#0DBD5E",
      LibIcon:"check"
    },
    {
      "No.absen": "09",
      "Nama": "Anies Rasyid Baswedan",
      "keterangan": "Hadir",
      "color": "#0DBD5E",
      LibIcon:"check"
    },

  ]

  

  const [popupVisible, setPopupVisible] = useState(false);
  
  function CustomPopup({ visible, onClose }: { visible: boolean, onClose: any,  }) {
    return (
      <Modal animationType="fade"
      transparent={true}
      visible={visible} >
      <View style={{flex:1,justifyContent:'center',alignContent:'center',backgroundColor: 'rgba(0, 0, 0, 0.116)',alignItems:'center'}}>

        <View style={{width: 300,padding: 20,backgroundColor: 'white',borderRadius: 10,alignItems: 'center',}}>
        {/* close button */}
        <TouchableOpacity onPress={onClose} style={{backgroundColor:'red',borderRadius:50,padding:10,position:'absolute',right:-15,top:-15}}>
            <LibIcon name="close" size={20} color="white" />
          </TouchableOpacity>

          <Text style={{fontSize: 16,marginBottom: 10,}}>Mengapa tidak  ikut pelajaran</Text>
          <Pressable onPress={onClose} style={{marginTop: 10,padding: 10,backgroundColor: '#FF4343',borderRadius: 5,width:"100%",alignItems:'center'}}>
            <Text style={{color: 'white',fontSize: 16,}}>Alfa</Text>
          </Pressable>

          <Pressable onPress={onClose} style={{marginTop: 10,padding: 10,backgroundColor: '#0083FD',borderRadius: 5,width:"100%",alignItems:'center'}}>
            <Text style={{color: 'white',fontSize: 16,}}>Izin</Text>
          </Pressable>

          <Pressable onPress={onClose} style={{marginTop: 10,padding: 10,backgroundColor: '#F6C956',borderRadius: 5,width:"100%",alignItems:'center'}}>
            <Text style={{color: 'white',fontSize: 16,}}>Sakit</Text>
          </Pressable>
        </View>
      </View>
    </Modal>
    )
  }

  return (
    <View style={{ flex: 1, backgroundColor: '#ffffff', alignContent: 'center', padding: 10 }}>



      {/* daftar siswa */}
      <FlatList data={datakelas}
        showsVerticalScrollIndicator={false}
        ListHeaderComponent={
          <View>
            <View style={{ flexDirection: 'row', justifyContent: 'space-between', alignItems: 'center', height: 30 }}>
              <Pressable onPress={() => LibNavigation.replace('teacher/index')} style={{ alignItems: 'center', }}>
                <View style={{ flexDirection: 'row', alignItems: 'center' }}>
                  <LibIcon.EntypoIcons name="chevron-left" size={30} color="black" />
                  <Text style={{ fontSize: 20 }}>{data}</Text>
                </View>
              </Pressable>
              <Text style={{ fontSize: 20 }}>jam ke 1-2</Text>
            </View>

            <View style={{ flexDirection: 'row', justifyContent: 'space-evenly', marginTop: 10 }}>
              {/* Berangkat */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'green', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>1</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Berangkat</Text>
              </View>
              {/* Sakit */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: 'orange', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>1</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Sakit</Text>
              </View>
              {/* Izin */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#0083fd', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>1</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Ijin</Text>
              </View>
              {/* Alfa */}
              <View style={{ height: 80, width: 80, alignItems: 'center', backgroundColor: '#FF4343', justifyContent: 'center', borderRadius: 10, padding: 12 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>1</Text>
                <Text style={{ fontSize: 12, fontWeight: 'bold', color: 'white' }}>Alfa</Text>
              </View>

            </View>

            {/* seperator */}
            <View style={{ height: 5, width: 'auto', backgroundColor: 'gray', marginTop: 10, marginHorizontal: 10, justifyContent: 'center', borderRadius: 5 }} />
          </View>
        }
        keyExtractor={(item, index) => index.toString()}
        renderItem={
          ({ item, index }) => {

            return (
              <View style={{ flexDirection: 'row', justifyContent: 'flex-start', marginTop: 10, alignItems: 'center', padding: 10 }}>
                <View style={{ flexDirection: 'row', justifyContent: 'flex-start', padding: 10, backgroundColor: item['color'], borderRadius: 10, height: 90, flex: 1 }}>
                  <View style={{ marginLeft: 5, alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', width: 40 }}>
                    <Text style={{ fontSize: 20, fontWeight: 'bold' }}>{item['No.absen']}</Text>
                  </View>
                  {/* nama siswa  && keterangan*/}
                  <View style={{ marginLeft: 10, alignItems: 'flex-start', justifyContent: 'center' }}>
                    <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{item['Nama']}</Text>

                    <View style={{ alignItems: 'center', padding: 5, backgroundColor: 'white', borderRadius: 5, justifyContent: 'center', marginTop: 10 }}>
                      <Text style={{ fontSize: 14, fontWeight: 'bold' }}>{item['keterangan']}</Text>
                    </View>
                  </View>

                </View>
                {/* make a circle */}
                <Pressable onPress={() => setPopupVisible(true)}style={{ backgroundColor: item['color'], borderRadius: 50, marginLeft: 20, padding: 20, height: 60, width: 60, alignItems: 'center', justifyContent: 'center' }}>
                  <LibIcon name={item['LibIcon']} size={34} color="#ffffff" />
                </Pressable>
                <CustomPopup visible={popupVisible} onClose={() => setPopupVisible(false)} />
              </View>
            )
          }} />
         <View style={{flexDirection:'row',justifyContent:'center',alignItems:'center',padding:10,height:80}}>
          <Pressable onPress={()=>LibNavigation.replace('teacher/index',{data:"Beranda"})} style={{backgroundColor:'#0083FD',borderRadius:10,padding:10,width:'80%',alignItems:'center',height:50,}}>
            <Text style={{color:'white',fontSize:16,alignSelf:'center'}}>Laporan</Text>
          </Pressable>
          </View>

   
    </View>
  )
}
export default memo(m);