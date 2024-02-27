// withHooks
import { useState } from 'react';

import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import React from 'react';
import { FlatList, Image, Pressable, Text, TouchableOpacity, View } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import { LibPicture } from 'esoftplay/cache/lib/picture/import';
import esp from 'esoftplay/esp';


export interface ParenChildArgs {

}
export interface ParenChildProps {

}

export default function m(props: ParenChildProps): any {
  const allDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

  const [selectedDay, setSelectedDay] = useState(allDays[0]);
  const kehadiran = [
    {
      kategori: 'Hadir',
      value: 30,
      color: '#0DBD5E',
    },
    {
      kategori: 'Sakit',
      value: 10,
      color: '#F6C956',
    },
    {
      kategori: 'Izin',
      value: 5,
      color: '#0083FD',
    },
    {
      kategori: 'Alfa',
      value: 5,
      color: '#FF4343',
    },

  ]
  const scheduleData = [
    { day: 'Monday', events: ['Mathematics', 'Physics', 'Chemistry'] },
    { day: 'Tuesday', events: ['History', 'Literature', 'English'] },
    { day: 'Wednesday', events: ['Biology', 'Physical Education', 'Lunch'] },
    { day: 'Thursday', events: ['Computer Science', 'Music', 'Art'] },
    { day: 'Friday', events: ['Geography', 'Foreign Language', 'Social Studies'] },
    { day: 'Saturday', events: ['Club Activities', 'Sports', 'Study Group'] },
    { day: 'Sunday', events: ['Rest day'] },
  ];

  const filteredSchedule = scheduleData.filter(item => item.day === selectedDay);
  
  return (
    <View style={{ flex: 1 }}>
      <ScrollView showsVerticalScrollIndicator={false}>

        <View style={{ flex: 1, backgroundColor: '#0073df', borderBottomRightRadius: 20, borderBottomLeftRadius: 20 }}>

          <View style={{ flexDirection: 'row', padding: 10, marginTop: 20, justifyContent: 'center' }}>
            <LibPicture source={esp.assets('anies.png')} style={{ width: 100, height: 100, borderRadius: 50, borderWidth: 5, borderColor: 'white', marginRight: 12 }} />

            <View style={{ justifyContent: 'center', alignItems: 'flex-start' }}>
              <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Anies Rasyid Baswedan</Text>
              <Text style={{ fontSize: 20, color: 'white', textAlign: 'center' }}>Presiden RI 2024</Text>
            </View>

          </View>

          <View style={{ flexDirection: 'row', padding: 10, marginVertical: 10, justifyContent: 'space-evenly' }}>
            <Pressable onPress={() => LibDialog.info("anda", 'TOLOL')} style={{ flexDirection: 'row', alignItems: 'center', padding: 20, backgroundColor: '#0aa724', borderRadius: 12, height: 70, }}>
              <LibIcon.FontAwesome name="phone" size={30} color="white" style={{ marginRight: 10 }} />
              <Text style={{ fontSize: 16, color: 'white' }}>Wa Guru</Text>
            </Pressable>

            <Pressable onPress={() => LibDialog.info("anda", 'TOLOL')} style={{ flexDirection: 'row', alignItems: 'center', padding: 20, backgroundColor: '#4B7AD6', borderRadius: 12, height: 70 }}>
              <LibIcon.FontAwesome name="user-circle" size={30} color="white" style={{ marginRight: 10 }} />
              <Text style={{ fontSize: 16, color: 'white' }}>Ijinkan Anak</Text>
            </Pressable>
          </View>
        </View>

        <View style={{ flex: 3, backgroundColor: '', padding: 20 }}>
          <Text style={{ fontSize: 20, fontWeight: 'bold' }}>kehadiran Anak</Text>
          <View style={{ flexDirection: 'row', marginVertical: 10, justifyContent: 'flex-start' }}>
            <View style={{ flexDirection: 'row', alignItems: 'center', padding: 5, backgroundColor: '#0aa724', borderRadius: 5, height: 40, marginRight: 5 }}>
              <Text style={{ fontSize: 15, color: 'white' }}>minggu ini</Text>
            </View>
            <View style={{ flexDirection: 'row', alignItems: 'center', padding: 5, backgroundColor: '#4B7AD6', borderRadius: 5, height: 40, marginRight: 5 }}>
              <Text style={{ fontSize: 15, color: 'white' }}>bulan ini</Text>
            </View>
            <View style={{ flexDirection: 'row', alignItems: 'center', padding: 5, backgroundColor: '#4B7AD6', borderRadius: 5, height: 40, marginRight: 5 }}>
              <Text style={{ fontSize: 15, color: 'white' }}>tahun ini</Text>
            </View>
          </View>

          <FlatList
            horizontal={true}  // Set the horizontal prop to true
            data={kehadiran}
            keyExtractor={(item, index) => index.toString()}
            contentContainerStyle={{ height: 80 }}
            showsHorizontalScrollIndicator={false}
            renderItem={({ item: kehadiranItem }) => (
              <View style={{ height: 80, width: 78, alignItems: 'center', backgroundColor: kehadiranItem.color, justifyContent: 'center', borderRadius: 10, padding: 5, marginRight: 10 }}>
                <Text style={{ fontSize: 16, fontWeight: 'bold', color: 'white' }}>{kehadiranItem.value}</Text>
                <Text style={{ fontSize: 18, fontWeight: 'bold', color: 'white' }}>{kehadiranItem.kategori}</Text>
              </View>
            )}
          />

          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 20 }}>Riwayat Absensi</Text>
          <Text style={{ fontSize: 20, fontWeight: 'bold', marginTop: 10 }}>Jadwal anak</Text>
          <View style={{ flexDirection: 'row', justifyContent: 'space-around', marginTop: 10,marginBottom:20}}>
            <ScrollView horizontal={true} showsHorizontalScrollIndicator={false}>
              {allDays.map(day => (
                <TouchableOpacity
                  key={day}
                  onPress={() => setSelectedDay(day)}
                  style={{
                    padding: 10,
                    backgroundColor: selectedDay === day ? '#4B7AD6' : 'lightgray',
                    borderRadius: 5,
                    marginRight: 10,
                  }}>
                  <Text style={{ color: selectedDay === day ? 'white' : 'black' }}>{day}</Text>
                </TouchableOpacity>
              ))}
            </ScrollView>
          </View>

          <FlatList
          data={filteredSchedule}
          horizontal={true}
          scrollEnabled={true}
          keyExtractor={(item, index) => index.toString()}
          contentContainerStyle={{ width: '100%' }}
          renderItem={({ item }) => (
            <View style={{ marginBottom: 20, width: '100%', backgroundColor: '#f0f0f0',  padding: 15 }}>
 
              <View>
                {item.events.map((event, index) => (
                  <View key={index} style={{ marginBottom: 10,height:100,backgroundColor:'#e7e7e7',borderRadius: 10,padding:15}}>
                    <Text style={{ fontSize: 16, color: '#555' }}>{index+1} {event}</Text>
                  </View>
                ))}
              </View>
            </View>
          )}
           />
        

        </View>


      </ScrollView>
    </View>
  )
}