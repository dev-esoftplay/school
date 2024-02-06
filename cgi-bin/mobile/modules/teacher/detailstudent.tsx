// withHooks
import { memo } from 'react';
import { useEffect, useRef, useState } from 'react';

import { LibIcon } from 'esoftplay/cache/lib/icon/import';
import React from 'react';
import { FlatList, Platform, Pressable, Text, View } from 'react-native';
import { ScrollView } from 'react-native-gesture-handler';
import { LibSlidingup } from 'esoftplay/cache/lib/slidingup/import';
import { LibDialog } from 'esoftplay/cache/lib/dialog/import';
import { LibNavigation } from 'esoftplay/cache/lib/navigation/import';
import { LibCurl } from 'esoftplay/cache/lib/curl/import';
import { get } from 'react-native/Libraries/TurboModule/TurboModuleRegistry';
import { err } from 'react-native-svg/lib/typescript/xml';


export interface TeacherDetailStudentArgs {

}
export interface TeacherDetailStudentProps {

}
function m(props: TeacherDetailStudentProps): any {
  function shadowS(value: any) {
    if (Platform.OS === "ios") {
      if (value === 0) return {};
      return { shadowColor: '#000000', shadowOffset: { width: 0, height: value / 2 }, shadowRadius: value, shadowOpacity: 0.24 }
    }
    return { elevation: value };
  }
  let slideup = useRef<LibSlidingup>(null)
  let [Eror, setEror] = useState("")
  const [klsSelected, setKlsSelected] = React.useState(false)
  const Absensi = [
    {
      "mapel": "Matematika",
      "pengajar": "Surya Paloh",
      "jam": "07:45-08:45",
      "ket": "Masuk",
      "color": "green"
    },
    {
      "mapel": "Fisika",
      "pengajar": "Surya Paloh",
      "jam": "08:45-09:45",
      "ket": "Absen",
      "color": "red"
    },
    {
      "mapel": "Matematika",
      "pengajar": "Surya Paloh",
      "jam": "09:45-10:45",
      "ket": "Masuk",
      "color": "green"
    },
    {
      "mapel": "Matematika",
      "pengajar": "Surya Paloh",
      "jam": "10:45-11:45",
      "ket": "Masuk",
      "color": "green"
    },
    {
      "mapel": "Matematika",
      "pengajar": "Surya Paloh",
      "jam": "11:45-12:45",
      "ket": "Masuk",
      "color": "green"
    }
  ];
  const Bulan = [
    {
      "name": "January",
      "abbreviation": "Jan",
      "number": 1,
      "days": 31
    },
    {
      "name": "February",
      "abbreviation": "Feb",
      "number": 2,
      "days": 28
    },
    {
      "name": "March",
      "abbreviation": "Mar",
      "number": 3,
      "days": 31
    },
    {
      "name": "April",
      "abbreviation": "Apr",
      "number": 4,
      "days": 30
    },
    {
      "name": "May",
      "abbreviation": "May",
      "number": 5,
      "days": 31
    },
    {
      "name": "June",
      "abbreviation": "Jun",
      "number": 6,
      "days": 30
    },
    {
      "name": "July",
      "abbreviation": "Jul",
      "number": 7,
      "days": 31
    },
    {
      "name": "August",
      "abbreviation": "Aug",
      "number": 8,
      "days": 31
    },
    {
      "name": "September",
      "abbreviation": "Sep",
      "number": 9,
      "days": 30
    },
    {
      "name": "October",
      "abbreviation": "Oct",
      "number": 10,
      "days": 31
    },
    {
      "name": "November",
      "abbreviation": "Nov",
      "number": 11,
      "days": 30
    },
    {
      "name": "December",
      "abbreviation": "Dec",
      "number": 12,
      "days": 31
    }
  ]
  
  const [resApi, setResApi] = useState<any>([])
  useEffect(() => {
  
      const url = "http://api.school.lc/homeroom_student_detail?student_id=1?class_id=1"
      new LibCurl('homeroom_student_detail?student_id=1?class_id=1', get, (result, msg) => {
        console.log("result detail siswa", result) 
        setResApi(result)

      }, (err) => {
        setEror(JSON.stringify(err))
        console.log("error", err)
        setResApi(null)
      }, 1)

    
  }, [])

  if(resApi == null ){
    return(
     <View style={{flex:1,justifyContent:'center',alignItems:'center'}}>
       <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>Tidak ada data</Text>
       <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black' }}>{Eror}</Text>
      </View>
    )
  }
 
  return (
    <View style={{ flex: 1 }}>
      <ScrollView style={{ flex: 1, padding: 20, marginBottom: 30, }}>

        <View style={{ flex: 1, flexDirection: 'row', paddingHorizontal: 10, alignItems: 'center' }}>
          <Pressable onPress={() => { LibNavigation.back() }} style={{ width: 40, height: 40, borderRadius: 20, backgroundColor: 'white', justifyContent: 'center', alignItems: 'center', }}>
            <LibIcon.EntypoIcons name='chevron-left' size={28} color='gray' />
          </Pressable>
          <Text style={{ fontSize: 18, fontWeight: 'bold', marginLeft: 10 }}>Detail Siswa</Text>
        </View>
        {/* CARD DETAIL SISWA */}
        <View style={{ flex: 1, backgroundColor: 'white', borderRadius: 10, marginTop: 50, padding: 10, ...shadowS(5), margin: 5 }}>
          {/* Row Detail siswa */}
          <View style={{ flexDirection: 'row', alignItems: 'center', paddingHorizontal: 20, paddingTop: 20 }}>
            <View style={{ width: 100, height: 100, borderRadius: 50, backgroundColor: '#dfd9d9', justifyContent: 'center', alignItems: 'center' }}>
              <LibIcon.AntDesign name='user' size={45} color='gray' />
            </View>

            <View style={{ marginLeft: 10 }}>
              <Text style={{ fontSize: 16, fontWeight: 'bold' }}>Nama Siswa</Text>
              <Text style={{ fontSize: 14 }}>Kelas 10 IPA 1</Text>
              <Text style={{ fontSize: 14 }}>NISN 123456789</Text>
              <Text style={{ fontSize: 14 }}>Nama Orang Tua </Text>
            </View>
          </View>

          {/* Button wa orang tua */}
          <Pressable onPress={() => { console.log('test') }} style={{ width: '90%', height: 60, backgroundColor: '#32b100', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginVertical: 20, ...shadowS(7), paddingHorizontal: 20, marginHorizontal: 10, marginTop: 35 }}>
            <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>
              <Text style={{ fontSize: 15, fontWeight: 'bold', color: '#ffffff', textAlign: 'center', }}>Hubungi Orang Tua</Text>
              {/* <FontAwesome name="whatsapp" size={24} color="black" /> */}
              <LibIcon.FontAwesome name="whatsapp" size={24} color="#ffffff" style={{ position: 'absolute', right: 20 }} />
            </View>
          </Pressable>


        </View>


        {/* CARD ABSENSI */}
        <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Absensi</Text>
        <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 20 }}>
        
        <View style={{ flexDirection: 'row', justifyContent: 'space-between', marginTop: 20 }}>
        <View style={{ width: 75, height: 70, backgroundColor: "green", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.hadir??"0"}</Text>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Hadir</Text>
        </View>
        <View style={{ width: 75, height: 70, backgroundColor: "green", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.sakit??"0"}</Text>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Hadir</Text>
        </View>
        <View style={{ width: 75, height: 70, backgroundColor: "green", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.ijin??"0"}</Text>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Hadir</Text>
        </View>
        <View style={{ width: 75, height: 70, backgroundColor: "green", borderRadius: 10, justifyContent: 'center', alignItems: 'center', paddingHorizontal: 10, marginHorizontal: 5 }}>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{resApi?.attendance_data?.tidak_hadir??"0"}</Text>
                  <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>Hadir</Text>
        </View>
        </View>
        
        </View>
        {/* button filter Slide Up */}
        <Pressable onPress={() => {
          slideup.current?.show()
          console.log('slide up')
        }
        } style={{
          height: 50, backgroundColor: 'white', borderRadius: 10, justifyContent: 'center', alignSelf: 'center', marginVertical: 30, ...shadowS(7), width: '98%',
          paddingHorizontal: 20, marginHorizontal: 15,
        }}>
          <View style={{ flexDirection: 'row', paddingHorizontal: 20 }}>

            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', textAlign: 'center', }}>Filter</Text>
            <LibIcon.Feather name="filter" size={20} color="black" style={{ position: 'absolute', right: 20 }} />
          </View>
        </Pressable>

        {/* card absensi */}
        <FlatList data={resApi.schedule_day}
          contentContainerStyle={{ paddingBottom: 20 }}
          
          renderItem={
            ({ item, index }) => {

              const getDay = (date: string) => {
                switch (date) {
                  case "0":
                    return "Minggu"
                  case "1":
                    return "Senin"
                  case "2":
                    return "Selasa"
                  case "3":
                    return "Rabu"
                  case "4":
                    return "Kamis"
                  case "5":
                    return "Jumat"
                  case "6":
                    return "Sabtu"
                  default:
                    return "Minggu"
                }
              }

              return (
                <Pressable onPress={() => LibDialog.info("test", "cakep")} style={{ backgroundColor: item['color'], padding: 10, width: '100%', paddingHorizontal: 20, borderRadius: 15, opacity: 0.8, ...shadowS(3), marginVertical: 10,height:80}}>

                  <View style={{flexDirection: 'row',}}>

                    <View style={{}}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{getDay(item?.day)}{item?.day??'Semoga senin'}</Text>
                      <View style={{height:20}}/>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white' }}>{item?.created_date??'Semoga senin'}</Text>
                    </View>
                  </View>
                </Pressable>
              )
            }
          } />
        {/* SLIDE UP */}
      </ScrollView>
      <LibSlidingup ref={slideup}>
        <View style={{ height: 300, backgroundColor: 'white', padding: 10, borderTopRightRadius: 20, borderTopLeftRadius: 20, paddingHorizontal: 20 }}>
          <Text style={{ fontSize: 20, fontWeight: 'bold', color: 'black', marginTop: 20, alignSelf: 'center' }}>Filter Absensi</Text>



          <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', marginTop: 20 }}>Pilih bulan</Text>
          <FlatList data={Bulan}

            keyExtractor={(item, index) => index.toString()}
            horizontal
            contentContainerStyle={{ marginTop: 10, height: 60 }}
            showsHorizontalScrollIndicator={false}
            renderItem={
              ({ item, index }) => {
                return (
                  <Pressable onPress={() => { setKlsSelected(true) }}>
                    <View style={{ flexDirection: 'row', justifyContent: 'center', marginRight: 10, height: 40, borderRadius: 12, borderWidth: 2, width: 'auto', paddingHorizontal: 10, alignItems: 'center', backgroundColor: klsSelected ? 'gray' : 'white' }}>
                      <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'black', alignSelf: 'center' }}>{item['name']}</Text>
                      <View style={{ height: 30 }} />
                    </View>
                  </Pressable>
                )
              }}
          />
          <Pressable onPress={() => { slideup.current?.hide() }} style={{ width: "100%", height: 60, backgroundColor: '#423a3a', borderRadius: 10, justifyContent: 'center', alignContent: 'center', marginTop: 20, }}>
            <Text style={{ fontSize: 15, fontWeight: 'bold', color: 'white', textAlign: 'center', }}>Terapkan</Text>
          </Pressable>
          <View style={{ height: 20 }} />

        </View>
      </LibSlidingup>
    </View>
  )
}
export default memo(m);